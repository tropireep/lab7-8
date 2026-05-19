document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector(".signin-form"); 
    const loginBtn = document.querySelector(".loginBtn"); 
    const messageBox = document.createElement("p");
    
    messageBox.classList.add("error-message");
    messageBox.style.color = "#ff4d4d";
    messageBox.style.marginTop = "15px";
    loginForm.appendChild(messageBox);

    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        messageBox.textContent = "";
        
        const loginInput = loginForm.querySelector("input[type='text']");
        const passwordInput = loginForm.querySelector("input[type='password']");
        
        loginBtn.disabled = true;
        messageBox.style.color = "#888";
        messageBox.textContent = "Зачекайте...";

        try {
            const response = await fetch("login_process.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    login: loginInput.value.trim(),
                    password: passwordInput.value.trim()
                })
            });

            const data = await response.json();
            loginBtn.disabled = false;

            if (data.success) {
                window.location.href = "admin.php";
            } else {
                messageBox.style.color = "#ff4d4d";
                messageBox.textContent = data.message;
            }
        } catch (error) {
            loginBtn.disabled = false;
            messageBox.style.color = "#ff4d4d";
            messageBox.textContent = "Помилка з'єднання з сервером.";
        }
    });
});