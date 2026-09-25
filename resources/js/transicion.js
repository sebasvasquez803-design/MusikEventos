const hambu = document.querySelector('.hambu');
const sidebar = document.querySelector('.sub_menu');

if (hambu && sidebar) {
    const anchor = hambu.querySelector('a');
    const toggle = (evt) => {
        if (evt) evt.preventDefault();
        sidebar.classList.toggle('active');
    };

    if (anchor) {
        anchor.addEventListener('click', toggle);
    } else {
        hambu.addEventListener('click', toggle);
    }

    document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !hambu.contains(e.target) && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
        }
    });

    sidebar.addEventListener('click', (evt) => {
        const link = evt.target.closest('a[data-genre]');
        if (!link) return;
        evt.preventDefault();
        const genre = link.dataset.genre || '';
        filterByGenre(genre);
        Array.from(sidebar.querySelectorAll('a[data-genre]')).forEach(a => a.classList.remove('selected-genre'));
        link.classList.add('selected-genre');
        sidebar.classList.remove('active');
    });
}

function filterByGenre(genre) {
    const cards = document.querySelectorAll('.contenedor');
    const normalized = (s) => (s || '').toString().toLowerCase();
    const g = normalized(genre);
    cards.forEach((card) => {
        const cardGenres = normalized(card.dataset.genero || '');
        if (!g) {
            card.style.display = '';
        } else if (cardGenres.split(',').map(x => x.trim().toLowerCase()).some(x => x === g)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

// ✅ Import del calendario modal
import { iniciarCalendarioModal } from './calendario-modal.js';

const infoToggleButtons = document.querySelectorAll('.info-toggle');
const infoPanel = document.getElementById('info-panel');
let selectedGroupPrice = 0;

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
            const reviews = button.dataset.reviews ? JSON.parse(button.dataset.reviews) : [];
            const canAdmin = button.dataset.canAdmin === '1';
            const reviewForm = document.querySelector('.info-panel__review-form');
            const nitInput = reviewForm ? reviewForm.querySelector('input[name="nit"]') : null;
            const groupNit = button.dataset.nit || '';

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
                reviewsContainer.innerHTML = reviews.map((review) => `
                    <article class="info-panel__review-card">
                        <div class="info-panel__review-header">
                            <div class="info-panel__review-avatar">${review.avatar || review.nombre.charAt(0).toUpperCase()}</div>
                            <div class="info-panel__review-meta">
                                <h4>${review.nombre}</h4>
                                <div class="info-panel__stars" aria-label="${review.estrellas || 5} estrellas">
                                    ${Array.from({ length: 5 }).map((_, i) => i < (review.estrellas || 5) ? '★' : '☆').join('')}
                                </div>
                            </div>
                        </div>
                        <p>${review.texto}</p>
                        ${canAdmin ? `
                            <div class="review-actions">
                                <button type="button" class="review-edit" data-id="${review.id_resena}">Editar</button>
                                <button type="button" class="review-delete" data-id="${review.id_resena}">Eliminar</button>
                            </div>
                        ` : ''}
                    </article>
                `).join('');
            }

            if (canAdmin && reviewsContainer) {
                reviewsContainer.addEventListener('click', (evt) => {
                    const editBtn = evt.target.closest('.review-edit');
                    if (editBtn) {
                        const id = editBtn.dataset.id;
                        const found = reviews.find(r => String(r.id_resena) === String(id));
                        const reviewForm = document.querySelector('.info-panel__review-form');
                        if (!reviewForm || !found) return;
                        reviewForm.querySelector('input[name="nombre_usuario"]').value = found.nombre || '';
                        reviewForm.querySelector('textarea[name="comentario"]').value = found.texto || '';
                        const select = reviewForm.querySelector('select[name="numero_estrellas"]');
                        if (select) select.value = String(found.estrellas || 5);
                        const editingInput = reviewForm.querySelector('#editing_id');
                        if (editingInput) editingInput.value = id;
                        const ratingStars = infoPanel.querySelector('.rating-stars');
                        const selectedLabel = infoPanel.querySelector('#selected-stars-label');
                        if (ratingStars) {
                            Array.from(ratingStars.querySelectorAll('.star')).forEach((btn) => {
                                const val = parseInt(btn.dataset.value, 10);
                                btn.textContent = val <= (found.estrellas || 5) ? '★' : '☆';
                                btn.classList.toggle('selected', val <= (found.estrellas || 5));
                            });
                        }
                        if (selectedLabel) selectedLabel.textContent = `${found.estrellas || 5} estrellas`;
                        const cancelBtn = document.getElementById('cancel-edit');
                        if (cancelBtn) cancelBtn.style.display = '';
                        return;
                    }

                    const delBtn = evt.target.closest('.review-delete');
                    if (delBtn) {
                        const id = delBtn.dataset.id;
                        if (!confirm('¿Deseas eliminar esta reseña?')) return;
                        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                        fetch(`/resenas/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json',
                            },
                        }).then((res) => {
                            if (res.ok) location.reload(); else alert('Error al eliminar');
                        }).catch(() => alert('Error al eliminar'));
                    }
                });
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

            // ✅ Iniciar calendario DESPUÉS de que el modal es visible
            setTimeout(() => {
                iniciarCalendarioModal(groupNit);
            }, 150);
        });
    });

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

            const fecha = document.getElementById('reserva-fecha')?.value || '';
            const hora = document.getElementById('reserva-hora')?.value || '';
            const direccion = document.getElementById('reserva-direccion')?.value.trim() || '';
            const nit = document.getElementById('reserva-nit')?.value || '';
            const grupo = document.getElementById('info-panel-name')?.textContent?.trim() || 'Grupo musical';
            const precio = selectedGroupPrice || 0;
            const currentRoute = window.carritoRoute || '/carrito';

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
