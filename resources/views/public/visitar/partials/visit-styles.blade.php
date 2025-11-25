<style>
/* Visit Page Header */
.visit-page-header {
    background: linear-gradient(135deg, var(--harvard-primary) 0%, var(--harvard-secondary) 100%);
    color: white;
    padding: 8rem 0 3rem;
    margin-top: 0;
    margin-bottom: 3rem;
}

.visit-page-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

/* Content Area */
.visit-content-area {
    padding: 2rem 0 4rem;
}

/* Visit Box */
.visit-box {
    background: linear-gradient(135deg, rgba(0, 168, 107, 0.08) 0%, rgba(14, 62, 73, 0.08) 100%);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border: 2px solid rgba(0, 168, 107, 0.15);
}

.visit-text-content {
    padding: 3rem 2.5rem;
    background: rgba(255, 255, 255, 0.95);
    font-size: 1.05rem;
    line-height: 1.8;
    color: #1e293b;
}

.section-title {
    color: var(--harvard-secondary);
    font-size: 1.75rem;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 1.25rem;
    border-bottom: 3px solid var(--harvard-primary);
    padding-bottom: 0.5rem;
}

.section-subtitle {
    color: var(--harvard-secondary);
    font-size: 1.4rem;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.visit-text-content p {
    margin-bottom: 1rem;
    text-align: justify;
}

.feature-list {
    list-style: none;
    padding: 0;
    margin: 1rem 0;
}

.feature-list li {
    padding: 0.75rem 0 0.75rem 2rem;
    position: relative;
    font-size: 1.05rem;
    line-height: 1.6;
    border-bottom: 1px solid rgba(0, 168, 107, 0.1);
}

.feature-list li:last-child {
    border-bottom: none;
}

.feature-list li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--harvard-primary);
    font-weight: 700;
    font-size: 1.3rem;
}

.contact-info {
    margin-top: 1.5rem;
    padding: 1.25rem;
    background: rgba(0, 168, 107, 0.05);
    border-radius: 8px;
    border-left: 4px solid var(--harvard-primary);
}

.contact-info p {
    padding: 0.5rem 0;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.contact-info p:last-child {
    margin-bottom: 0;
}

.contact-info strong {
    color: var(--harvard-secondary);
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .visit-page-header {
        padding: 6rem 0 2rem;
    }

    .visit-page-title {
        font-size: 1.75rem;
    }

    .visit-text-content {
        padding: 1.5rem;
    }

    .section-title {
        font-size: 1.5rem;
    }

    .section-subtitle {
        font-size: 1.2rem;
    }
}
</style>
