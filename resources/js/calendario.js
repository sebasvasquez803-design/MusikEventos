// import './bootstrap';

// Importar el Constructor de FullCalendar y sus plugins
import { Calendar } from 'fullcalendar';
import dayGridPlugin from 'fullcalendar/daygrid';
import interactionPlugin from 'fullcalendar/interaction'; // Habilita clics y drag-and-drop

// Importar las hojas de estilos CSS obligatorias
import 'fullcalendar/skeleton.css';

// Hacer disponible la clase y plugins globalmente en la ventana (Window)
window.Calendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.interactionPlugin = interactionPlugin;
