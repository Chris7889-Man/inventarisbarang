<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login | Inventaris BPKP</title>
<style>
.login-wrapper,
.login-wrapper * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica,
    Arial, sans-serif;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #050508;
}

.login-wrapper {
  --blob-1-color: #ff5e00;
  --blob-2-color: #7000ff;
  --btn-hover-glow: rgba(112, 0, 255, 0.25);
  --input-focus-glow: rgba(112, 0, 255, 0.15);
  position: relative;
  animation: floatUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  opacity: 0;
  transform: translateY(30px);
}

@keyframes floatUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.login-card {
  position: relative;
  width: 460px;
  background-color: #0d0f14;
  border-radius: 28px;
  padding: 40px 48px;
  overflow: hidden;
  box-shadow:
    0 24px 48px rgba(0, 0, 0, 0.2),
    0 8px 16px rgba(0, 0, 0, 0.1);
  transition:
    transform 0.5s cubic-bezier(0.16, 1, 0.3, 1),
    box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

.login-wrapper:hover .login-card {
  transform: translateY(-6px);
  box-shadow:
    0 32px 64px rgba(0, 0, 0, 0.3),
    0 12px 24px rgba(0, 0, 0, 0.15);
}

.glow-blob {
  position: absolute;
  filter: blur(45px);
  border-radius: 50%;
  z-index: 0;
  opacity: 0.6;
  animation: pulseGlow 4s infinite alternate ease-in-out;
  transition:
    opacity 0.5s ease,
    filter 0.5s ease;
}

.login-wrapper:hover .glow-blob {
  opacity: 0.75;
  filter: blur(40px);
}

.blob-1 {
  top: -30px;
  right: -30px;
  width: 170px;
  height: 170px;
  background: var(--blob-1-color);
}

.blob-2 {
  bottom: -50px;
  left: -50px;
  width: 210px;
  height: 210px;
  background: var(--blob-2-color);
  animation-delay: -2s;
}

@keyframes pulseGlow {
  0% {
    transform: scale(0.9);
    opacity: 0.5;
  }
  100% {
    transform: scale(1.1);
    opacity: 0.7;
  }
}

.dark-overlay {
  position: absolute;
  inset: 0;
  background: radial-gradient(
    circle at 50% 50%,
    rgba(5, 5, 8, 0.85) 30%,
    transparent 100%
  );
  z-index: 1;
  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.05);
  border-radius: inherit;
}

.view-container {
  position: relative;
  z-index: 10;
}

.form-view {
  display: flex;
  flex-direction: column;
  animation: fadeInView 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes fadeInView {
  from {
    opacity: 0;
    transform: translateY(15px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.header {
  margin-bottom: 28px;
  text-align: center;
}

.logo {
  width: 150px;
  height: 150px;
  object-fit: contain;
  margin: 0 auto 1em auto;
  display: block;
  border-radius: 16px;
}

.title {
  color: #ffffff;
  font-size: 26px;
  font-weight: 500;
  letter-spacing: -0.5px;
  margin-bottom: 8px;
}

.subtitle {
  color: rgba(255, 255, 255, 0.6);
  font-size: 15px;
  font-weight: 400;
}

.error-msg {
  color: #ff6b6b;
  font-size: 13px;
  text-align: center;
  margin-bottom: 16px;
  padding: 10px;
  background: rgba(255, 107, 107, 0.08);
  border: 1px solid rgba(255, 107, 107, 0.2);
  border-radius: 10px;
}

.input-group {
  margin-bottom: 20px;
  position: relative;
}

.input-field {
  width: 100%;
  padding: 1.15em 1.3em;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  color: #ffffff;
  font-size: 16px;
  font-family: inherit;
  outline: none;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}

.input-field::placeholder {
  color: rgba(255, 255, 255, 0.4);
}

.input-field:focus {
  background: rgba(255, 255, 255, 0.06);
  border-color: rgba(255, 255, 255, 0.25);
  box-shadow: 0 0 20px var(--input-focus-glow);
  transform: translateY(-2px);
}

.input-field:-webkit-autofill,
.input-field:-webkit-autofill:hover,
.input-field:-webkit-autofill:focus,
.input-field:-webkit-autofill:active {
  -webkit-box-shadow: 0 0 0 1000px #0d0f14 inset !important;
  -webkit-text-fill-color: #ffffff !important;
  transition: background-color 5000s ease-in-out 0s;
}

.forgot-link {
  display: block;
  text-align: right;
  color: rgba(255, 255, 255, 0.6);
  font-size: 14px;
  text-decoration: none;
  margin-top: -8px;
  margin-bottom: 28px;
  transition: color 0.2s ease;
}

.forgot-link:hover {
  color: #ffffff;
}

.btn-submit {
  width: 100%;
  padding: 1.1em;
  background: rgba(255, 255, 255, 0.1);
  color: #ffffff;
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 14px;
  font-size: 17px;
  font-weight: 500;
  font-family: inherit;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}

.btn-submit:hover {
  background: rgba(255, 255, 255, 0.15);
  border-color: rgba(255, 255, 255, 0.4);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px var(--btn-hover-glow);
}

.btn-submit:active {
  transform: translateY(0);
}
</style>
</head>
<body>

<div class="login-wrapper">
  <div class="login-card">
    <div class="glow-blob blob-1"></div>
    <div class="glow-blob blob-2"></div>
    <div class="dark-overlay"></div>

    <div class="view-container">
      <div class="form-view" id="login-view">
        <div class="header">
          <img src="/image.png" alt="Logo" class="logo" />
          <div class="title">Welcome Back</div>
          <p class="subtitle">Please enter your details to sign in.</p>
        </div>

        @if($errors->any())
          <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/login">
          @csrf
          <div class="input-group">
            <input
              type="email"
              name="email"
              class="input-field"
              placeholder="Email address"
              required=""
              autocomplete="email"
              value="{{ old('email') }}"
            />
          </div>

          <div class="input-group">
            <input
              type="password"
              name="password"
              class="input-field"
              placeholder="Password"
              required=""
              autocomplete="current-password"
            />
          </div>

          <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>

          <button type="submit" class="btn-submit">Sign In</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>