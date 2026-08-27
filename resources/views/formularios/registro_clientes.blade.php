<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Registro de Clientes</title>
  <link rel="stylesheet" href="../css/REGISTRO DE CLIENTES.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <main class="card" role="main">
    
    <div class="sidebar">
      <div class="logo-container">
        <img src="../img/musike.png" alt="Logo de la Empresa" class="logo-img" />
      </div>
      <h2>BIENVENIDO AL REGISTRO DE CLIENTES</h2>
      
      <div class="photo-upload-zone">
        <i class="fa-solid fa-camera camera-icon"></i>
        <span>FOTO DE PERFIL / LOGO</span>
        <button type="button" class="btn-upload">Subir</button>
      </div>

      <div class="sidebar-info-text">
        <p>Por favor, complete todos los campos obligatorios del formulario adjunto para formalizar el registro del cliente en el sistema.</p>
      </div>
    </div>

    <div class="form-container">
      <header class="card-header">
        <div class="header-badge">REGISTRO DE CLIENTES</div>
      </header>

      <form id="clienteForm" class="form" novalidate>
        
        <section class="section">
          <h2>DATOS GENERALES</h2>
          <div class="form-row">
            <label class="field">
              <input type="text" name="nombre" placeholder="Nombre completo o Razón Social" autocomplete="name" required />
            </label>
            <label class="field">
              <input type="email" name="email" placeholder="Correo electrónico" autocomplete="email" required />
            </label>
          </div>
          <div class="form-row">
            <label class="field">
              <input type="tel" name="telefono" placeholder="Número telefónico" autocomplete="tel" pattern="^\+?\d{7,15}$" />
            </label>
            <label class="field">
              <input type="text" name="documento" placeholder="Documento (DNI / NIT)" required />
            </label>
          </div>
        </section>

        <section class="section">
          <h2>DATOS DE UBICACIÓN Y PERFIL</h2>
          <div class="form-row">
            <label class="field">
              <input type="text" name="direccion" placeholder="Dirección de residencia" autocomplete="street-address" />
            </label>
            <label class="field">
              <input type="date" name="nacimiento" title="Fecha de nacimiento o constitución" />
            </label>
          </div>
          <div class="form-row">
            <label class="field">
              <select name="tipo" required>
                <option value="">Tipo de cliente...</option>
                <option value="natural">Persona natural</option>
                <option value="juridica">Persona jurídica</option>
              </select>
            </label>
            <label class="field-empty"></label>
          </div>
        </section>

        <section class="section">
          <h2>PRESENCIA DIGITAL Y MEDIA</h2>
          <div class="form-row">
            <div class="input-icon-wrapper">
              <span class="input-icon"><i class="fa-solid fa-globe"></i></span>
              <input type="url" name="web" placeholder="Sitio web corporativo (https://...)" />
            </div>
            <div class="input-icon-wrapper">
              <span class="input-icon"><i class="fa-brands fa-linkedin"></i></span>
              <input type="url" name="linkedin" placeholder="Perfil de LinkedIn" />
            </div>
          </div>
        </section>

        <section class="section">
          <h2>INFORMACIÓN ADICIONAL Y LEGAL</h2>
          <div class="form-row">
            <label class="field" style="flex: 2;">
              <textarea name="notas" rows="2" placeholder="Notas o descripción general del cliente..." style="width: 100%; border: 1.5px solid var(--input-border); border-radius: 6px; padding: 10px; font-family: inherit; resize: none; outline: none;"></textarea>
            </label>
          </div>
          <div class="form-row">
            <label class="checkbox-field">
              <input type="checkbox" name="consentimiento" required />
              <span style="color: var(--text-dark); font-size: 13px;">Acepto el tratamiento de datos personales</span>
            </label>
          </div>
        </section>

        <div class="actions">
          <button type="submit" class="btn-primary">Registrar</button>
        </div>
      </form>
    </div>

  </main>

  <script src="../js/REGISTRO DE CLIENTES.js"></script>
</body>
</html>
