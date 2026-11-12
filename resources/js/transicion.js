const sidebar = document.querySelector('.sub_menu');

if (sidebar) {
    sidebar.addEventListener('click', (evt) => {
        const link = evt.target.closest('a[data-genre]');
        if (!link) return;
        evt.preventDefault();
        const genre = link.dataset.genre || '';
        filterByGenre(genre, link.textContent.trim());

        sidebar.querySelectorAll('a[data-genre]').forEach((item) => {
            const isSelected = item === link;
            item.classList.toggle('selected-genre', isSelected);
            if (isSelected) {
                item.setAttribute('aria-current', 'true');
            } else {
                item.removeAttribute('aria-current');
            }
        });
    });
}

function filterByGenre(genre, genreLabel) {
    const cards = document.querySelectorAll('.contenedor');
    const normalized = (s) => (s || '')
        .toString()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .toLowerCase();
    const g = normalized(genre);
    let visibleCards = 0;

    cards.forEach((card) => {
        const cardGenres = normalized(card.dataset.genero || '');
        const matchesGenre = !g || cardGenres.split(',').some((item) => item.trim() === g);
        card.hidden = !matchesGenre;
        if (matchesGenre) visibleCards++;
    });

    const status = document.getElementById('genre-filter-status');
    if (status) {
        const genreName = genreLabel || 'todos los géneros';
        status.textContent = `${visibleCards} ${visibleCards === 1 ? 'grupo visible' : 'grupos visibles'} de ${genreName} en esta página.`;
    }
}

const infoToggleButtons = document.querySelectorAll('.info-toggle');
const infoPanel = document.getElementById('info-panel');
let selectedGroupPrice = 0;

document.querySelectorAll('.home-hero__artist-card:not([aria-hidden="true"])').forEach((card) => {
    card.addEventListener('click', () => {
        const groupButton = Array.from(infoToggleButtons).find((button) => button.dataset.nit === card.dataset.groupNit);
        groupButton?.click();
    });
});

if (infoPanel) {
    const nameEl = document.getElementById('info-panel-name');
    const tagEl = document.getElementById('info-panel-tag');
    const tagSecondaryEl = document.getElementById('info-panel-tag-secondary');
    const imageEl = document.getElementById('info-panel-image');
    const logoEl = document.getElementById('info-panel-logo');
    const thumbEl = document.getElementById('info-panel-thumb');
    const titleEl = document.getElementById('info-panel-title');
    const descriptionEl = document.getElementById('info-panel-description');
    const priceEl = document.getElementById('info-panel-price');
    const reviewsContainer = document.getElementById('info-panel-reviews');
    const videoFrame = document.getElementById('info-panel-iframe');
    const videoElement = document.getElementById('info-panel-video');
    const reviewsCache = new Map();
    let activeReviews = [];
    let activeReviewGroupNit = '';
    let activeReviewCanManage = false;

    const loadReviews = (url) => {
        if (!reviewsCache.has(url)) {
            const request = fetch(url, { headers: { Accept: 'application/json' } })
                .then((response) => {
                    if (!response.ok) throw new Error(`No se pudieron cargar las reseñas (${response.status}).`);
                    return response.json();
                })
                .then((payload) => {
                    if (!Array.isArray(payload.reviews)) throw new Error('La respuesta de reseñas no es válida.');
                    return payload.reviews;
                })
                .catch((error) => {
                    reviewsCache.delete(url);
                    throw error;
                });

            reviewsCache.set(url, request);
        }

        return reviewsCache.get(url);
    };

    const renderReviews = (reviews) => {
        if (!reviewsContainer) return;

        activeReviews = reviews;
        const cards = reviews.map((review) => {
            const article = document.createElement('article');
            article.className = 'info-panel__review-card';

            const header = document.createElement('div');
            header.className = 'info-panel__review-header';
            const avatar = document.createElement('div');
            avatar.className = 'info-panel__review-avatar';
            avatar.textContent = review.avatar || (review.nombre || 'U').charAt(0).toUpperCase();

            const meta = document.createElement('div');
            meta.className = 'info-panel__review-meta';
            const name = document.createElement('h4');
            name.textContent = review.nombre || 'Usuario';
            const stars = document.createElement('div');
            stars.className = 'info-panel__stars';
            stars.setAttribute('aria-label', `${review.estrellas || 5} estrellas`);
            stars.textContent = Array.from({ length: 5 }, (_, index) => (
                index < (review.estrellas || 5) ? '★' : '☆'
            )).join('');
            meta.append(name, stars);
            header.append(avatar, meta);

            const text = document.createElement('p');
            text.textContent = review.texto || 'Excelente experiencia.';
            article.append(header, text);

            if (activeReviewCanManage && review.id_resena !== null) {
                const actions = document.createElement('div');
                actions.className = 'review-actions';
                actions.innerHTML = '<button type="button" class="review-edit">Editar</button><button type="button" class="review-delete">Eliminar</button>';
                actions.querySelector('.review-edit').dataset.id = review.id_resena;
                actions.querySelector('.review-delete').dataset.id = review.id_resena;
                article.append(actions);
            }

            return article;
        });

        reviewsContainer.replaceChildren(...cards);
    };

    const closeInfoPanel = () => {
        infoPanel.classList.remove('active');
        infoPanel.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };

    infoToggleButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const name = button.dataset.name || 'Grupo musical';
            const image = button.dataset.image || '/storage/img/inside.jpeg';
            const logo = button.dataset.logo || '/storage/img/logo_arca.jpg';
            const description = button.dataset.description || 'Grupo musical disponible para eventos.';
            const price = button.dataset.price || 'Consultar precio';
            selectedGroupPrice = Number(String(price).replace(/[^\d]/g, '')) || 0;
            const tag = button.dataset.tag || 'Grupo musical';
            const genre = button.dataset.genre || '';
            const videoUrl = button.dataset.video || '';
            const reviewsUrl = button.dataset.reviewsUrl || '';
            const canAdmin = button.dataset.canAdmin === '1';
            const reviewForm = document.querySelector('.info-panel__review-form');
            const nitInput = reviewForm ? reviewForm.querySelector('input[name="nit"]') : null;
            const groupNit = button.dataset.nit || '';
            activeReviewGroupNit = groupNit;
            activeReviewCanManage = canAdmin;
            activeReviews = [];

            if (nitInput) {
                nitInput.value = groupNit;
            }

            // ✅ Asignar NIT al campo hidden del formulario de reserva
            const reservaNitInput = document.getElementById('reserva-nit');
            if (reservaNitInput) {
                reservaNitInput.value = groupNit;
            }

            if (nameEl) nameEl.textContent = name;
            if (tagEl) tagEl.textContent = tag;
            if (tagSecondaryEl) tagSecondaryEl.textContent = genre || 'Disponible';
            if (imageEl) {
                imageEl.src = image;
                imageEl.alt = name;
            }
            if (logoEl) {
                logoEl.src = logo;
                logoEl.alt = `${name} logo`;
            }
            if (thumbEl) {
                thumbEl.src = image;
                thumbEl.alt = name;
            }
            if (titleEl) titleEl.textContent = name;
            if (descriptionEl) descriptionEl.textContent = description;
            if (priceEl) priceEl.textContent = price;
            if (reviewsContainer) {
                reviewsContainer.textContent = 'Cargando reseñas...';
            }

            if (videoFrame || videoElement) {
                if (!videoUrl || !videoUrl.trim()) {
                    if (videoFrame) {
                        videoFrame.removeAttribute('src');
                        videoFrame.classList.remove('is-visible');
                        videoFrame.classList.add('is-hidden');
                    }
                    if (videoElement) {
                        videoElement.removeAttribute('src');
                        videoElement.classList.remove('is-visible');
                        videoElement.classList.add('is-hidden');
                    }
                } else {
                    const isYoutubeUrl = /youtube\.com|youtu\.be/i.test(videoUrl);

                    if (isYoutubeUrl) {
                        let embedUrl = videoUrl;
                        if (embedUrl.includes('youtube.com/watch?v=')) {
                            const match = embedUrl.match(/[?&]v=([^&]+)/i);
                            if (match && match[1]) embedUrl = `https://www.youtube.com/embed/${match[1]}`;
                        } else if (embedUrl.includes('youtu.be/')) {
                            const match = embedUrl.match(/youtu\.be\/([^?]+)/i);
                            if (match && match[1]) embedUrl = `https://www.youtube.com/embed/${match[1]}`;
                        }
                        const refreshedUrl = `${embedUrl}${embedUrl.includes('?') ? '&' : '?'}refresh=${Date.now()}`;
                        if (videoFrame) {
                            videoFrame.src = refreshedUrl;
                            videoFrame.classList.remove('is-hidden');
                            videoFrame.classList.add('is-visible');
                        }
                        if (videoElement) {
                            videoElement.removeAttribute('src');
                            videoElement.classList.remove('is-visible');
                            videoElement.classList.add('is-hidden');
                        }
                    } else {
                        if (videoElement) {
                            videoElement.src = videoUrl;
                            videoElement.classList.remove('is-hidden');
                            videoElement.classList.add('is-visible');
                            videoElement.load();
                        }
                        if (videoFrame) {
                            videoFrame.removeAttribute('src');
                            videoFrame.classList.remove('is-visible');
                            videoFrame.classList.add('is-hidden');
                        }
                    }
                }
            }

            (function initRatingInPanel() {
                const reviewForm = document.querySelector('.info-panel__review-form');
                const select = reviewForm ? reviewForm.querySelector('select[name="numero_estrellas"]') : null;
                const ratingStars = infoPanel.querySelector('.rating-stars');
                const selectedLabel = infoPanel.querySelector('#selected-stars-label');
                const initial = select ? parseInt(select.value, 10) || 5 : 5;
                if (ratingStars) {
                    Array.from(ratingStars.querySelectorAll('.star')).forEach((btn) => {
                        const val = parseInt(btn.dataset.value, 10);
                        btn.textContent = val <= initial ? '★' : '☆';
                        btn.classList.toggle('selected', val <= initial);
                    });
                }
                if (selectedLabel) selectedLabel.textContent = `${initial} estrellas`;
                if (select) select.value = String(initial);
            })();

            infoPanel.classList.add('active');
            infoPanel.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            if (reviewsUrl && reviewsContainer) {
                loadReviews(reviewsUrl)
                    .then((reviews) => {
                        if (activeReviewGroupNit === groupNit) renderReviews(reviews);
                    })
                    .catch((error) => {
                        if (activeReviewGroupNit !== groupNit) return;
                        reviewsContainer.textContent = 'No se pudieron cargar las reseñas. Intenta de nuevo.';
                        console.error(error);
                    });
            }

            // ✅ Iniciar calendario DESPUÉS de que el modal es visible
            setTimeout(() => {
                import('./calendario-modal.js').then(({ iniciarCalendarioModal }) => {
                    iniciarCalendarioModal(groupNit);
                });
            }, 150);
        });
    });

    if (reviewsContainer) {
        reviewsContainer.addEventListener('click', (event) => {
            const editButton = event.target.closest('.review-edit');
            if (editButton && activeReviewCanManage) {
                const review = activeReviews.find((item) => String(item.id_resena) === editButton.dataset.id);
                const reviewForm = document.querySelector('.info-panel__review-form');
                if (!reviewForm || !review) return;

                reviewForm.querySelector('input[name="nombre_usuario"]').value = review.nombre || '';
                reviewForm.querySelector('textarea[name="comentario"]').value = review.texto || '';
                const select = reviewForm.querySelector('select[name="numero_estrellas"]');
                if (select) select.value = String(review.estrellas || 5);
                const editingInput = reviewForm.querySelector('#editing_id');
                if (editingInput) editingInput.value = editButton.dataset.id;

                const ratingStars = infoPanel.querySelector('.rating-stars');
                const selectedLabel = infoPanel.querySelector('#selected-stars-label');
                if (ratingStars) {
                    Array.from(ratingStars.querySelectorAll('.star')).forEach((button) => {
                        const value = parseInt(button.dataset.value, 10);
                        button.textContent = value <= (review.estrellas || 5) ? '★' : '☆';
                        button.classList.toggle('selected', value <= (review.estrellas || 5));
                    });
                }
                if (selectedLabel) selectedLabel.textContent = `${review.estrellas || 5} estrellas`;
                const cancelButton = document.getElementById('cancel-edit');
                if (cancelButton) cancelButton.style.display = '';
                return;
            }

            const deleteButton = event.target.closest('.review-delete');
            if (!deleteButton || !activeReviewCanManage || !confirm('¿Deseas eliminar esta reseña?')) return;

            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            fetch(`/resenas/${deleteButton.dataset.id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    Accept: 'application/json',
                },
            }).then((response) => {
                if (response.ok) location.reload();
                else alert('Error al eliminar');
            }).catch(() => alert('Error al eliminar'));
        });
    }

    const closeButtons = infoPanel.querySelectorAll('.info-panel__close');
    closeButtons.forEach((button) => {
        button.addEventListener('click', closeInfoPanel);
    });

    infoPanel.addEventListener('click', (event) => {
        if (event.target === infoPanel) {
            closeInfoPanel();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && infoPanel.classList.contains('active')) {
            closeInfoPanel();
        }
    });

    (function setupRatingInteraction() {
        const ratingContainer = infoPanel.querySelector('.rating-stars');
        if (!ratingContainer) return;

        ratingContainer.addEventListener('click', (evt) => {
            const btn = evt.target.closest('.star');
            if (!btn) return;
            const value = parseInt(btn.dataset.value, 10) || 0;
            const reviewForm = document.querySelector('.info-panel__review-form');
            const select = reviewForm ? reviewForm.querySelector('select[name="numero_estrellas"]') : null;
            const label = infoPanel.querySelector('#selected-stars-label');

            Array.from(ratingContainer.querySelectorAll('.star')).forEach((b) => {
                const v = parseInt(b.dataset.value, 10);
                b.textContent = v <= value ? '★' : '☆';
                b.classList.toggle('selected', v <= value);
            });

            if (select) select.value = String(value);
            if (label) label.textContent = `${value} estrellas`;
        });
    })();

    const confirmReservaBtn = document.getElementById('btn-confirmar-reserva');
    if (confirmReservaBtn) {
        confirmReservaBtn.addEventListener('click', (event) => {
            event.preventDefault();

            if (confirmReservaBtn.dataset.authenticated !== '1') {
                alert('Debes iniciar sesión para reservar un grupo musical.');
                window.location.href = '/login';
                return;
            }

            const fecha = document.getElementById('reserva-fecha')?.value || '';
            const hora = document.getElementById('reserva-hora')?.value || '';
            const direccionInput = document.getElementById('reserva-direccion');
            const direccion = direccionInput?.value.trim() || '';
            const nit = document.getElementById('reserva-nit')?.value || '';
            const grupo = document.getElementById('info-panel-name')?.textContent?.trim() || 'Grupo musical';
            const precio = selectedGroupPrice || 0;
            const currentRoute = window.carritoRoute || '/carrito';

            if (!direccion) {
                alert('Ingresa la dirección del evento para continuar.');
                direccionInput?.focus();
                return;
            }

            const params = new URLSearchParams({
                fecha,
                hora,
                direccion,
                nit,
                grupo,
                precio_hora: String(precio),
            });

            window.location.href = `${currentRoute}?${params.toString()}`;
        });
    }

    (function setupFormHandlers() {
        const reviewForm = document.querySelector('.info-panel__review-form');
        if (!reviewForm) return;
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        reviewForm.addEventListener('submit', (evt) => {
            evt.preventDefault();
            const editingId = reviewForm.querySelector('#editing_id')?.value || '';
            const formAction = reviewForm.getAttribute('action');
            const formData = new FormData(reviewForm);

            if (editingId) {
                fetch(`/resenas/${editingId}`, {
                    method: 'PUT',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                    body: formData,
                }).then((res) => {
                    if (res.ok) location.reload(); else res.json().then(j => alert(j.message || 'Error al actualizar'));
                }).catch(() => alert('Error al actualizar'));
            } else {
                fetch(formAction, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                    body: formData,
                }).then((res) => {
                    if (res.ok) location.reload(); else res.json().then(j => alert(j.message || 'Error al crear'));
                }).catch(() => alert('Error al crear'));
            }
        });

        const cancelBtn = document.getElementById('cancel-edit');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                reviewForm.querySelector('#editing_id').value = '';
                reviewForm.reset();
                const ratingStars = document.querySelector('.rating-stars');
                if (ratingStars) {
                    Array.from(ratingStars.querySelectorAll('.star')).forEach((btn) => {
                        const val = parseInt(btn.dataset.value, 10);
                        btn.textContent = val <= 5 ? '★' : '☆';
                        btn.classList.toggle('selected', val <= 5);
                    });
                }
                const selectedLabel = document.getElementById('selected-stars-label');
                if (selectedLabel) selectedLabel.textContent = '5 estrellas';
                cancelBtn.style.display = 'none';
            });
        }
    })();
}
