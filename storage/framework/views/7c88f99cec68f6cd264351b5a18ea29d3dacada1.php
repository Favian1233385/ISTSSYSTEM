<div class="social-floating">
    <a href="https://facebook.com/istsucua" target="_blank" aria-label="Facebook" rel="noopener">
        <img src="<?php echo e(asset('assets/images/footer/facebook.png')); ?>" alt="Facebook" width="36" height="36">
    </a>
    <a href="https://x.com/istsucua" target="_blank" aria-label="X" rel="noopener">
        <img src="<?php echo e(asset('assets/images/footer/x.png')); ?>" alt="X (Twitter)" width="36" height="36">
    </a>
    <a href="https://instagram.com/istsucua" target="_blank" aria-label="Instagram" rel="noopener">
        <img src="<?php echo e(asset('assets/images/footer/instagram.png')); ?>" alt="Instagram" width="36" height="36">
    </a>
    <a href="https://tiktok.com/@ist_sucua" target="_blank" aria-label="TikTok" rel="noopener">
        <img src="<?php echo e(asset('assets/images/footer/tiktok.png')); ?>" alt="TikTok" width="36" height="36">
    </a>
</div>
<style>
.social-floating {
    position: fixed;
    top: 50%;
    right: 18px;
    z-index: 1050;
    display: flex;
    flex-direction: column;
    gap: 12px;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.85);
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    padding: 8px 4px;
    transition: background 0.2s;
}
.social-floating a img {
    filter: grayscale(0.2) brightness(0.95);
    transition: filter 0.2s, transform 0.2s;
}
.social-floating a:hover img {
    filter: none;
    transform: scale(1.12);
}
@media (max-width: 768px) {
    .social-floating {
        top: unset;
        bottom: 80px;
        right: 10px;
        flex-direction: row;
        border-radius: 12px;
        padding: 6px 2px;
    }
}
</style>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/partials/social_floating.blade.php ENDPATH**/ ?>