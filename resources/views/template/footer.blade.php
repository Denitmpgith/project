<footer id="footerId" class="col-span-12 lg:col-start-1 lg:col-span-12 grid grid-cols-12 bg-neutral-900">
    <div class="col-start-3 col-span-8">
        <div class="grid grid-cols-12 pt-3 gap-3 text-white">
            <div class="col-span-3 h-20 text-center">
                <p>Category</p>
            </div>
            <div class="col-span-3 h-20 text-center">
                <p>Contest Rules</p>
            </div>
            <div class="col-span-3 h-20 text-center">
                <p>About Us</p>
            </div>
            <div class="col-span-3 h-20 text-center">
                <p>Contact</p>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-start-2 lg:col-span-10 py-3 flex justify-center">
        <small class="text-white text-center">&copy; 2023 company Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></small>
    </div>
</footer>
</html>
<script>
    var bodyElement = document.body;
    var footerElement = document.getElementById('footerId');
    var tinggiKonten = bodyElement.clientHeight;
    var tinggiLayar = window.innerHeight;

    if (tinggiKonten < tinggiLayar) {
    footerElement.style.position = 'absolute';
    footerElement.style.bottom = '0';
    footerElement.style.width = '100%';
    }
</script>