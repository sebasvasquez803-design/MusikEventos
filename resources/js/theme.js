const root = document.documentElement;
const themeMeta = document.querySelector('meta[name="user-theme"]');
const updateUrl = document.querySelector('meta[name="theme-update-url"]')?.content;
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
const validThemes = new Set(['light', 'dark']);

function applyTheme(theme) {
    const nextTheme = validThemes.has(theme) ? theme : 'light';
    root.dataset.theme = nextTheme;
    root.classList.toggle('dark', nextTheme === 'dark');

    const button = document.querySelector('.theme-toggle');
    if (button) {
        const isDark = nextTheme === 'dark';
        button.setAttribute('aria-label', `Cambiar al modo ${isDark ? 'día' : 'noche'}`);
        button.title = `Activar modo ${isDark ? 'día' : 'noche'}`;
        button.querySelector('.theme-toggle__icon').className =
            `theme-toggle__icon fa-solid ${isDark ? 'fa-sun' : 'fa-moon'}`;
        button.querySelector('.theme-toggle__label').textContent =
            `Modo ${isDark ? 'día' : 'noche'}`;
    }

    return nextTheme;
}

function showSaveError(button) {
    const status = button.querySelector('.theme-toggle__status');
    status.textContent = 'No se pudo guardar el tema. Intenta de nuevo.';
    status.classList.add('is-visible');
}

let storedTheme = null;
if (!updateUrl) {
    try {
        storedTheme = localStorage.getItem('musik-eventos-theme');
    } catch (error) {
        console.error('Unable to read the local theme preference.', error);
    }
}

const initialTheme = themeMeta?.content || storedTheme || 'light';
applyTheme(initialTheme);

const toggle = document.createElement('button');
toggle.type = 'button';
toggle.className = 'theme-toggle';
toggle.innerHTML = `
    <i class="theme-toggle__icon fa-solid" aria-hidden="true"></i>
    <span class="theme-toggle__label"></span>
    <span class="theme-toggle__status" role="status" aria-live="polite"></span>
`;
document.body.append(toggle);
applyTheme(initialTheme);

toggle.addEventListener('click', async () => {
    const previousTheme = root.dataset.theme;
    const nextTheme = previousTheme === 'dark' ? 'light' : 'dark';
    applyTheme(nextTheme);
    toggle.disabled = true;

    try {
        if (updateUrl) {
            const response = await fetch(updateUrl, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ theme: nextTheme }),
            });

            if (!response.ok) {
                throw new Error(`Theme preference request failed with status ${response.status}`);
            }
        } else {
            localStorage.setItem('musik-eventos-theme', nextTheme);
        }

        const status = toggle.querySelector('.theme-toggle__status');
        status.textContent = '';
        status.classList.remove('is-visible');
    } catch (error) {
        console.error('Unable to save the theme preference.', error);
        applyTheme(previousTheme);
        showSaveError(toggle);
    } finally {
        toggle.disabled = false;
    }
});
