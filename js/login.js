document.getElementById('login-form').addEventListener('submit', function (event) {
    event.preventDefault();
  
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
  
    // Add your login logic here
    console.log('Login attempted with:', { email, password });
  
    // You can add form validation or handle the login API call here
    if (email === '' || password === '') {
      alert('Please fill in all fields');
    } else {
      alert(`Logging in with email: ${email}`);
      // You can add an API call here to handle login
    }
  });
  