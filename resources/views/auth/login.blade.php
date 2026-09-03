<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Login | Inventaris BPKP</title>
<style>
.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  background-color: #1f1f1f;
  padding: 30px;
  width: 450px;
  border-radius: 20px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  border: 1px solid #333;
}

::placeholder {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  color: #aaa;
}

.form button {
  align-self: flex-end;
}

.flex-column > label {
  color: #f1f1f1;
  font-weight: 600;
}

.inputForm {
  border: 1.5px solid #333;
  border-radius: 10px;
  height: 50px;
  display: flex;
  align-items: center;
  padding-left: 10px;
  transition: 0.2s ease-in-out;
  background-color: #2b2b2b;
}

.input {
  margin-left: 10px;
  border-radius: 10px;
  border: none;
  width: 100%;
  height: 100%;
  background-color: #2b2b2b;
  color: #f1f1f1;
}

.input:focus {
  outline: none;
}

.inputForm:focus-within {
  border: 1.5px solid #2d79f3;
}

.flex-row {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 10px;
  justify-content: space-between;
}

.flex-row > div > label {
  font-size: 14px;
  color: #f1f1f1;
  font-weight: 400;
}

.span {
  font-size: 14px;
  margin-left: 5px;
  color: #2d79f3;
  font-weight: 500;
  cursor: pointer;
}

.button-submit {
  margin: 20px 0 10px 0;
  background-color: #2d79f3;
  border: none;
  color: white;
  font-size: 15px;
  font-weight: 500;
  border-radius: 10px;
  height: 50px;
  width: 100%;
  cursor: pointer;
}

.p {
  text-align: center;
  color: #f1f1f1;
  font-size: 14px;
  margin: 5px 0;
}

.btn {
  margin-top: 10px;
  width: 100%;
  height: 50px;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: 500;
  gap: 10px;
  border: 1px solid #333;
  background-color: #2b2b2b;
  color: #f1f1f1;
  cursor: pointer;
  transition: 0.2s ease-in-out;
}

.btn:hover {
  border: 1px solid #2d79f3;
}
.error-msg {
    color: #ff6b6b;
    font-size: 13px;
    margin-bottom: 10px;
    text-align: center;
}
</style>
</head>
<body style="display:flex; justify-content:center; align-items:center; min-height:100vh; background-color:#121212;">

<form class="form" method="POST" action="/login">
  @csrf
  <div class="text-center" style="margin-bottom:20px;">
      <img src="/image.png" style="max-height:80px; margin-bottom:10px;">
      <h3 style="color:#fff;">Inventaris BPKP</h3>
  </div>

  @if($errors->any())
    <div class="error-msg">⚠️ {{ $errors->first() }}</div>
  @endif

  <div class="flex-column">
    <label>Email </label>
  </div>
  <div class="inputForm">
    <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg">
      <g id="Layer_3" data-name="Layer 3">
        <path fill="#fff" d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path>
      </g>
    </svg>
    <input type="email" name="email" class="input" placeholder="Enter your Email" required />
  </div>

  <div class="flex-column">
    <label>Password </label>
  </div>
  <div class="inputForm">
    <svg height="20" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
      <path fill="#fff" d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path>
      <path fill="#fff" d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path>
    </svg>
    <input type="password" name="password" class="input" placeholder="Enter your Password" required />
  </div>

  <div class="flex-row">
    <div>
      <input type="checkbox" name="remember" />
      <label>Remember me </label>
    </div>
    <span class="span">Forgot password?</span>
  </div>
  <button class="button-submit">Sign In</button>
  <p class="p">Don't have an account? <span class="span">Sign Up</span></p>
</form>
</body>
</html>
