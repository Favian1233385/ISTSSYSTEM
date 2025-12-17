
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
