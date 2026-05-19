document.addEventListener("DOMContentLoaded", function() {
    
    // ==========================================
    // 1. БУРГЕР-МЕНЮ
    // ==========================================
    const burger = document.getElementById('burger-menu');
    const nav = document.querySelector('.nav');
    const body = document.body;

    if (burger && nav) {
        burger.addEventListener('click', function() {
            burger.classList.toggle('active');
            nav.classList.toggle('active');
            body.classList.toggle('lock');
        });
    }
    const navLinks = document.querySelectorAll('.nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if(burger) burger.classList.remove('active');
            if(nav) nav.classList.remove('active');
            body.classList.remove('lock');
        });
    });

    // ==========================================
    // 2. ФОРМА ПІДПИСКИ
    // ==========================================
    const form = document.getElementById("project-form"); 
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            
            let isValid = true;
            const fields = ['name', 'email', 'budget', 'subject', 'message'];

            fields.forEach(field => {
                const input = document.getElementById(field);
                if (input) {
                    input.classList.remove("error");
                    if (!input.value.trim()) {
                        input.classList.add("error");
                        isValid = false;
                    }
                }
            });
            const emailField = form.querySelector("#email");
            if (emailField && !emailPattern.test(emailField.value.trim())) {
                emailField.classList.add("error");
                isValid = false;
            }

            if (isValid) {
                let formData = {
                    name: document.getElementById("name").value.trim(),
                    email: document.getElementById("email").value.trim(),
                    budget: document.getElementById("budget").value.trim(),
                    subject: document.getElementById("subject").value.trim(),
                    message: document.getElementById("message").value.trim()
                };

                fetch("subscriptions.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        form.reset(); 
                        alert(data.message || "Дякуємо за підписку!");
                    } else {
                        alert(data.message || "Сталася помилка.");
                    }
                })
                .catch(() => alert("Сталася помилка при відправці."));
            }
        });

        const allInputs = form.querySelectorAll('input, textarea');
        allInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });
    } // <--- ОСЬ ТУТ ЗАКРИВАЄТЬСЯ БЛОК ФОРМИ

    // ==========================================
    // 3. СЛАЙДЕР ВІДГУКІВ (SWIPER) - КОД 8.8
    // ==========================================
    // Спочатку перевіряємо, чи є взагалі на сторінці елемент ".swiper"
    if (document.querySelector(".swiper")) {
        new Swiper(".swiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 1800,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            }
        });
    }

});