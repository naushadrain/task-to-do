$(document).ready(function () {
    const loginForm = $('#login-form');
    const registerForm = $('#register-form');

    $('#show-register').on('click', function () {
        loginForm.addClass('form-hidden');
        registerForm.removeClass('form-hidden');
    });

    $('#show-login').on('click', function () {
        registerForm.addClass('form-hidden');
        loginForm.removeClass('form-hidden');
    });
});