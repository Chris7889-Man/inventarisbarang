<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Forgot Password | Inventaris BPKP</title>
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
}

@keyframes floatUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

.login-card {
  position: relative;
  width: 460px;
  background-color: #0d0f14;
  border-radius: 28px;
  padding: 40px 48px;
  overflow: hidden;
  box-shadow: 0 24px 48px rgba(0,0,0,0.2);
}

.glow-blob {
  position: absolute;
  filter: blur(45px);
  border-radius: 50%;
  z-index: 0;
  opacity: 0.6;
}

.blob-1 { top: -30px; right: -30px; width: 170px; height: 170px; background: var(--blob-1-color); }
.blob-2 { bottom: -50px; left: -50px; width: 210px; height: 210px; background: var(--blob-2-color); }

.dark-overlay {
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(5,5,8,0.85) 30%, transparent 100%);
  z-index: 1;
  border-radius: inherit;
}

.view-container { position: relative; z-index: 10; }

.header { margin-bottom: 28px; text-align: center; }

.logo { width: 150px; height: 150px; object-fit: contain; margin: 0 auto 1em auto; display: block; }

.title { color: #ffffff; font-size: 26px; font-weight: 500; margin-bottom: 8px; }

.subtitle { color: rgba(255,255,255,0.6); font-size: 15px; }

.status-msg { color: #51cf66; font-size: 13px; text-align: center; margin-bottom: 16px; padding: 10px; background: rgba(81, 207, 102, 0.08); border: 1px solid rgba(81, 207, 102, 0.2); border-radius: 10px; }

.error-msg { color: #ff6b6b; font-size: 13px; text-align: center; margin-bottom: 16px; padding: 10px; background: rgba(255,107,107,0.08); border: 1px solid rgba(255,107,107,0.2); border-radius: 10px; }

.input-field {
  width: 100%;
  padding: 1.15em 1.3em;
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 14px;
  color: #ffffff;
  font-size: 16px;
  outline: none;
  margin-bottom: 20px;
}

.btn-submit {
  width: 100%;
  padding: 1.1em;
  background: rgba(255,255,255,0.1);
  color: #ffffff;
  border: 1px solid rgba(255,255,255,0.2);
  border-radius: 14px;
  font-size: 17px;
  font-weight: 500;
  cursor: pointer;
}

.back-link { display: block; text-align: center; color: rgba(255,255,255,0.6); font-size: 14px; text-decoration: none; margin-top: 20px; }
</style>
</head>
<body>
<div class="login-wrapper">
  <div class="login-card">
    <div class="glow-blob blob-1"></div>
    <div class="glow-blob blob-2"></div>
    <div class="dark-overlay"></div>
    <div class="view-container">
        <div class="header">
          <img src="/image.png" alt="Logo" class="logo" />
          <div class="title">Reset Password</div>
          <p class="subtitle">Enter your email to receive a reset link.</p>
        </div>

        @if(session('status'))
          <div class="status-msg">{{ session('status') }}</div>
        @endif

        @if($errors->any())
          <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <input type="email" name="email" class="input-field" placeholder="Email address" required autofocus />
          <button type="submit" class="btn-submit">Send Reset Link</button>
        </form>
        
        <a href="{{ route('login') }}" class="back-link">Back to Login</a>
    </div>
  </div>
</div>
</body>
</html>