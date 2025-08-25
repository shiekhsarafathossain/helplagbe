<footer class="footer-modern">
    <div class="footer-content">
        <!-- Quick Links -->
        <div class="footer-links">
            <a href="./service_provider/index.php" class="footer-btn">Service Provider Panel</a>
            <a href="./admin_panel/index.php" class="footer-btn">Admin Panel</a>
        </div>

        <!-- Copyright -->
        <p class="footer-text">© 2025 Help Lagbe | Sheikh Sarafat Hossain. All rights reserved.</p>
    </div>

    <!-- Footer CSS -->
    <style>
        .footer-modern {
            width: 100%;
            margin: 0;
            padding: 20px 10px;
            clear: both;
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: #fff;
            text-align: center;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .footer-links {
            display: flex;
            gap: 15px;
        }

        .footer-btn {
            background: #fff;
            color: #007bff;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .footer-btn:hover {
            background: #007bff;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

    </style>
</footer>




<!-- Fix for footer to stay at bottom even with short content -->
<!-- CHATGPT -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const footer = document.querySelector("footer");
        const body = document.body;
        if (body.offsetHeight < window.innerHeight) {
            footer.style.position = "absolute";
            footer.style.bottom = "0";
        } else {
            footer.style.position = "relative";
        }
    });
</script>
