<style>
    footer {
        background-color: #eaf2f7;
        background-color: #fff;
        font-family: 'Sen', sans-serif;
        color: #1d3557;
    }
    footer .brand-logo {
        font-family: 'Permanent Marker', cursive;
        font-size: 2rem;
        color: #f35367;
    }
    footer .footer-menu-title {
        font-size: 1.1rem;
        font-weight: bolder;
        margin-bottom: 15px;
    }
    footer ul.footer-menu {
        list-style-type: none;
        padding-left: 0;
    }
    footer ul.footer-menu  li{
        margin-bottom: 5px;
        font-size: 0.9rem;
    }
    footer ul.footer-menu li a{
        color: inherit;
    }
    footer ul.footer-menu li a:hover{
        border-bottom: 1px solid #1d3557;
    }
    
</style>
<footer class="p-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="brand-logo">Chhitomitho</div>
            </div>
            <div class="col-6 col-md-2">
                <div class="footer-menu-title">About Us</div>
                <ul class="footer-menu">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Offer</a></li>
                    <li><a href="#">Careers</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2">
                <div class="footer-menu-title">Legal</div>
                <ul class="footer-menu">
                    <li><a href="{{ route('page.privacy_policy') }}">Privacy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2">
                <div class="footer-menu-title">Help</div>
                <ul class="footer-menu">
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">FAQ's</a></li>
                    <li><a href="#">For Business</a></li>
                    <li><a href="#">Advertise</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2">
                <div class="footer-menu-title">Social</div>
                <ul class="footer-menu">
                    <li><a href="#"><i class="fab fa-facebook-square mr-2"></i>Facebook</a></li>
                    <li><a href="#"><i class="fab fa-twitter-square mr-2"></i>Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>