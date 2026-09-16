const hambu = document.querySelector('.hambu');
const sidebar = document.querySelector('.sub_menu');

if (hambu && sidebar) {
    hambu.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
}

const infoToggleButtons = document.querySelectorAll('.info-toggle');
const infoPanel = document.getElementById('info-panel');

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
            const tag = button.dataset.tag || 'Grupo musical';
            const videoUrl = button.dataset.video || '';
            const reviews = button.dataset.reviews ? JSON.parse(button.dataset.reviews) : [];
            const reviewForm = document.querySelector('.info-panel__review-form');
            const nitInput = reviewForm ? reviewForm.querySelector('input[name="nit"]') : null;
            const groupNit = button.dataset.nit || '';

            if (nitInput) {
                nitInput.value = groupNit;
            }

            if (nameEl) nameEl.textContent = name;
            if (tagEl) tagEl.textContent = tag;
            if (tagSecondaryEl) tagSecondaryEl.textContent = 'Disponible';
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
                                <div class="info-panel__stars" aria-label="5 estrellas">★★★★★</div>
                            </div>
                        </div>
                        <p>${review.texto}</p>
                    </article>
                `).join('');
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
                            if (match && match[1]) {
                                embedUrl = `https://www.youtube.com/embed/${match[1]}`;
                            }
                        } else if (embedUrl.includes('youtu.be/')) {
                            const match = embedUrl.match(/youtu\.be\/([^?]+)/i);
                            if (match && match[1]) {
                                embedUrl = `https://www.youtube.com/embed/${match[1]}`;
                            }
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

            infoPanel.classList.add('active');
            infoPanel.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
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
}