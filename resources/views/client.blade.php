<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />




<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>


<style>

:root {
  --navy:    #0D1B3E;
  --orange:  #F97316;
  --orange2: #EA580C;
  --muted:   #8A9BBE;
  --border:  #E8EDF6;
  --white:   #FFFFFF;
  --text:    #1A2B4A;
  --subtle:  #6B7FA3;
}

/* ══════════════════════════════
   Conteneur du panneau formulaire
══════════════════════════════ */
.qf-panel {
  width: 100%;
  max-width: 460px;
  background: var(--white);
  border-radius: 24px;
  padding: 52px 48px 44px;
  box-shadow:
    0 2px 4px rgba(13,27,62,0.04),
    0 12px 40px rgba(13,27,62,0.10),
    0 0 0 1px rgba(13,27,62,0.05);
  position: relative;
  overflow: hidden;
}

/* Accent orange en haut */
.qf-panel::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--navy) 0%, var(--orange) 50%, var(--navy) 100%);
}

/* ── Entête (remplace le logo) ── */
.qf-eyebrow {
  display: flex; align-items: center; gap: 10px;
  margin-bottom: 28px;
}
.qf-eyebrow-line {
  flex: 1; height: 1px; background: var(--border);
}
.qf-eyebrow-tag {
  display: flex; align-items: center; gap: 6px;
  background: #FFF5ED;
  border: 1px solid rgba(249,115,22,0.2);
  border-radius: 100px;
  padding: 5px 14px;
  font-family: 'DM Sans', sans-serif;
  font-size: 10px; letter-spacing: 0.14em; text-transform: uppercase;
  color: var(--orange2); font-weight: 500;
}
.qf-eyebrow-tag .dot {
  width: 5px; height: 5px; border-radius: 50%;
  background: var(--orange);
  box-shadow: 0 0 6px var(--orange);
  animation: pulse-dot 2s ease-in-out infinite;
}
@keyframes pulse-dot {
  0%,100% { opacity: 1; } 50% { opacity: 0.4; }
}

/* ── Titre & sous-titre ── */
.qf-header { margin-bottom: 36px; }
.qf-header h2 {
  font-family: 'Playfair Display', serif;
  font-size: 32px; font-weight: 700;
  color: var(--navy); line-height: 1.15;
  margin-bottom: 8px;
}
.qf-header h2 em {
  font-style: normal;
  background: linear-gradient(90deg, var(--orange), var(--orange2));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}
.qf-header p {
  font-family: 'DM Sans', sans-serif;
  font-size: 13.5px; color: var(--subtle); line-height: 1.65;
}

/* ── Champs ── */
.qf-row { display: flex; gap: 16px; }
.qf-row .qf-field { flex: 1; }

.qf-field { margin-bottom: 20px; }
.qf-field label {
  display: block;
  font-family: 'DM Sans', sans-serif;
  font-size: 10px; letter-spacing: 0.13em; text-transform: uppercase;
  color: var(--subtle); margin-bottom: 8px; font-weight: 500;
}

.qf-input-wrap {
  position: relative; display: flex; align-items: center;
}
.qf-input-wrap .material-icons-round {
  position: absolute; left: 14px;
  font-size: 17px; color: #C5CEDF;
  pointer-events: none;
  transition: color 0.2s;
}
.qf-input-wrap:focus-within .material-icons-round {
  color: var(--orange);
}

.qf-input-wrap input {
  width: 100%;
  background: #F7F9FC;
  border: 1.5px solid var(--border);
  border-radius: 12px;
  padding: 13px 16px 13px 42px;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px; color: var(--text);
  outline: none;
  transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
}
.qf-input-wrap input::placeholder {
  color: #B8C4D8; font-size: 13.5px;
}
.qf-input-wrap input:focus {
  background: var(--white);
  border-color: var(--orange);
  box-shadow: 0 0 0 3.5px rgba(249,115,22,0.10);
}

/* ── Séparateur discret ── */
.qf-divider {
  height: 1px; background: var(--border);
  margin: 8px 0 24px;
}

/* ── Bouton principal ── */
.qf-btn {
  width: 100%;
  padding: 15px 20px;
  background: var(--navy);
  border: none; border-radius: 14px;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px; font-weight: 600; letter-spacing: 0.03em;
  color: var(--white);
  cursor: pointer;
  display: flex; align-items: center; justify-content: center; gap: 9px;
  position: relative; overflow: hidden;
  box-shadow: 0 6px 24px rgba(13,27,62,0.18);
  transition: transform 0.15s, box-shadow 0.2s;
}
/* Trait orange animé au survol */
.qf-btn::after {
  content: '';
  position: absolute; bottom: 0; left: 0;
  width: 0; height: 3px;
  background: linear-gradient(90deg, var(--orange), var(--orange2));
  transition: width 0.3s ease;
}
.qf-btn:hover { transform: translateY(-1px); box-shadow: 0 10px 32px rgba(13,27,62,0.22); }
.qf-btn:hover::after { width: 100%; }
.qf-btn:active { transform: scale(0.98); }
.qf-btn .material-icons-round { font-size: 18px; color: var(--orange); }

/* ── Footer liens ── */
.qf-footer {
  margin-top: 24px;
  display: flex; justify-content: center; gap: 20px;
}
.qf-footer a {
  font-family: 'DM Sans', sans-serif;
  font-size: 10px; letter-spacing: 0.1em; text-transform: uppercase;
  color: #B8C4D8; text-decoration: none;
  transition: color 0.2s;
}
.qf-footer a:hover { color: var(--subtle); }

/* ── Animations d'entrée ── */
.qf-panel > * {
  opacity: 0; transform: translateY(14px);
  animation: qfUp 0.45s ease forwards;
}
.qf-eyebrow  { animation-delay: 0.08s; }
.qf-header   { animation-delay: 0.16s; }
.qf-form     { animation-delay: 0.24s; }
.qf-footer   { animation-delay: 0.32s; }
@keyframes qfUp {
  to { opacity: 1; transform: translateY(0); }
}

/* ── Responsive ── */
@media (max-width: 500px) {
  .qf-panel { padding: 36px 24px 32px; border-radius: 0; }
  .qf-row   { flex-direction: column; gap: 0; }
}
</style>

<!-- ════ PANNEAU FORMULAIRE ════ -->

<div class="qf-panel">

  <!-- Pastille "En cours de service" -->

  <div class="qf-eyebrow">
    <div class="qf-eyebrow-line"></div>
    <div class="qf-eyebrow-tag">
      <div class="dot"></div>
      <span>Service en cours</span>
    </div>
    <div class="qf-eyebrow-line"></div>
  </div>

  <!-- Titre -->

  <div class="qf-header">
    <h2>Rejoignez<br/>la <em>file</em> en ligne.</h2>
    <p>Renseignez vos informations pour obtenir<br/>votre numéro de passage instantanément.</p>
  </div>

  <!-- Formulaire -->

  <form class="qf-form" method="post" action="{{ route('login') }}">
    @csrf

```
<!-- Nom & Prénom -->
<div class="qf-row">
  <div class="qf-field">
    <label for="nom">Nom</label>
    <div class="qf-input-wrap">
      <span class="material-icons-round">badge</span>
      <input
        id="nom" name="nom" type="text"
        placeholder="Dupont"
        value="{{ old('nom') }}"
        autocomplete="family-name"
        required />
    </div>
  </div>
  <div class="qf-field">
    <label for="prenom">Prénom</label>
    <div class="qf-input-wrap">
      <span class="material-icons-round">person</span>
      <input
        id="prenom" name="prenom" type="text"
        placeholder="Marie"
        value="{{ old('prenom') }}"
        autocomplete="given-name"
        required />
    </div>
  </div>
</div>

<!-- Téléphone -->
<div class="qf-field">
  <label for="telephone">Numéro de téléphone</label>
  <div class="qf-input-wrap">
    <span class="material-icons-round">phone</span>
    <input
      id="telephone" name="telephone" type="tel"
      placeholder="+33 6 12 34 56 78"
      value="{{ old('telephone') }}"
      autocomplete="tel"
      required />
  </div>
</div>

<div class="qf-divider"></div>

<!-- Bouton -->
<button class="qf-btn" type="submit">
  <span class="material-icons-round">confirmation_number</span>
  Obtenir mon ticket
</button>
```

  </form>

  <!-- Liens bas de page -->

  <div class="qf-footer">
    <a href="#">Politique de confidentialité</a>
    <a href="#">Conditions d'utilisation</a>
  </div>

</div>
<!-- ════ FIN PANNEAU ════ -->
</x-guest-layout>
