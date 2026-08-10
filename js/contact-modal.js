document.addEventListener("DOMContentLoaded", function() {

    // ===== MODAL LOGIC =====
    const openBtn = document.getElementById("openContactModal");
    const modal = document.getElementById("contactModal");
    const closeBtn = document.querySelector(".contact-modal__close");
    const overlay = document.querySelector(".contact-modal__overlay");

    if (!openBtn || !modal) return;

    openBtn.addEventListener("click", function() {
        modal.classList.add("active");
        document.body.style.overflow = "hidden";
    });

    function closeModal() {
        modal.classList.remove("active");
        document.body.style.overflow = "";
    }

    closeBtn.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);

    // ===== FORM SUBMIT LOGIC =====
    const form = document.getElementById("contactForm");

    if (!form) return;

    form.addEventListener("submit", async function(e) {
        e.preventDefault();

        const name = form.querySelector('[name="name"]').value.trim();
        const email = form.querySelector('[name="email"]').value.trim();
        const message = form.querySelector('[name="message"]').value.trim();

        if (!name || !email || !message) {
            alert("Please fill all fields");
            return;
        }

        try {
            const response = await fetch("/contact", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ name, email, message }),
            });

            let statusMsg = form.querySelector(".form-status-msg");
            if (!statusMsg) {
                statusMsg = document.createElement("p");
                statusMsg.className = "form-status-msg";
                statusMsg.style.cssText = "margin-top:1.2rem; font-size:1.4rem; font-weight:600;";
                form.appendChild(statusMsg);
            }

            if (response.ok) {
                statusMsg.textContent = "Message sent! We'll be in touch soon.";
                statusMsg.style.color = "#2a7a2a";
                form.reset();
                setTimeout(closeModal, 2000);
            } else {
                statusMsg.textContent = "Failed to send. Please try again.";
                statusMsg.style.color = "#c0392b";
            }

        } catch (error) {
            let statusMsg = form.querySelector(".form-status-msg");
            if (!statusMsg) {
                statusMsg = document.createElement("p");
                statusMsg.className = "form-status-msg";
                statusMsg.style.cssText = "margin-top:1.2rem; font-size:1.4rem; font-weight:600;";
                form.appendChild(statusMsg);
            }
            statusMsg.textContent = "Something went wrong. Please try again.";
            statusMsg.style.color = "#c0392b";
            console.error(error);
        }
    });

});