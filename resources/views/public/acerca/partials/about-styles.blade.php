<style>
/* About Section Styles - Harvard Inspired */

/* Page Header */
.about-page-header {
    background: linear-gradient(135deg, var(--harvard-primary) 0%, var(--harvard-secondary) 100%);
    padding: 8rem 0 1rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.about-page-title {
    font-size: 2.8rem;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

/* Content Area */
.about-content-area {
    padding: 3rem 0;
}

.about-content-area .container {
    max-width: 1400px;
}

.about-box {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 3px solid var(--harvard-primary);
    border-radius: 12px;
    padding: 3rem;
    margin-bottom: 2rem;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    position: relative;
}

.about-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--harvard-primary) 0%, var(--harvard-secondary) 100%);
    border-radius: 12px 12px 0 0;
}

/* Two-column layout for image and text */
.about-content-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    align-items: stretch;
}

.about-image-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    min-height: 400px;
}

.about-image-container img {
    width: 100%;
    height: 100%;
    max-height: 600px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: 3px solid var(--harvard-primary);
    object-fit: contain;
}

.about-text-content {
    color: #333;
    line-height: 1.5;
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    border: 2px solid var(--harvard-primary);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
    overflow-y: auto;
}

.about-text-content p {
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
    text-align: justify;
}

.about-text-content h1,
.about-text-content h2,
.about-text-content h3 {
    margin-top: 0.75rem;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.about-text-content strong {
    font-size: 1rem;
}

.section-title {
    color: var(--harvard-primary);
    font-weight: 700;
    font-size: 2rem;
    border-bottom: 3px solid var(--harvard-secondary);
    padding-bottom: 0.75rem;
    margin-bottom: 2rem;
}

.section-subtitle {
    color: var(--harvard-secondary);
    font-weight: 600;
    font-size: 1.5rem;
    margin-top: 2.5rem;
    margin-bottom: 1.5rem;
}

/* Feature Lists */
.feature-list {
    list-style: none;
    padding: 0;
    margin: 1.5rem 0;
}

.feature-list li {
    padding: 0.75rem 0;
    padding-left: 2rem;
    position: relative;
    font-size: 1.1rem;
    line-height: 1.6;
    color: #333;
}

.feature-list li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--harvard-primary);
    font-weight: 700;
    font-size: 1.3rem;
}

/* Team Grid */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.team-member-card {
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.team-member-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 168, 107, 0.2);
    border-color: var(--harvard-primary);
}

.team-member-img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    border-bottom: 3px solid var(--harvard-primary);
}

.team-member-info {
    padding: 1.5rem;
}

.team-member-info h3 {
    color: var(--harvard-secondary);
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
}

.team-member-info .position,
.team-member-info .department {
    color: var(--harvard-primary);
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.team-member-info .bio,
.team-member-info p {
    color: #555;
    font-size: 0.95rem;
    line-height: 1.6;
}

/* Authority Profile Layout - Horizontal Design */
.authority-profile-layout {
    display: grid;
    grid-template-columns: 380px 1fr;
    gap: 0;
    background: #ffffff;
    border-radius: 0;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    min-height: 600px;
}

.authority-image-section {
    background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    padding: 2rem 1.5rem;
    border-right: 3px solid var(--harvard-primary);
}

.authority-profile-image {
    width: 100%;
    max-width: 320px;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    margin-bottom: 1.5rem;
    border: 3px solid var(--harvard-primary);
}

.authority-name-card {
    text-align: center;
    background: #ffffff;
    padding: 1.5rem;
    border-radius: 8px;
    width: 100%;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.authority-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--harvard-secondary);
    margin: 0 0 0.5rem 0;
    line-height: 1.3;
}

.authority-position {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--harvard-primary);
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.authority-info-section {
    background: linear-gradient(135deg, #f0f9f5 0%, #e8f4f8 100%);
    padding: 3rem;
    display: flex;
    flex-direction: column;
}

.authority-bio-content {
    font-size: 1.05rem;
    line-height: 1.9;
    color: #2c3e50;
}

.authority-bio-content h3,
.authority-bio-content h4 {
    color: var(--harvard-primary);
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-size: 1.4rem;
}

.authority-bio-content h3:first-child,
.authority-bio-content h4:first-child {
    margin-top: 0;
}

.authority-bio-content ul {
    list-style: none;
    padding-left: 0;
    margin: 1rem 0;
}

.authority-bio-content ul li {
    padding: 0.5rem 0 0.5rem 1.5rem;
    position: relative;
    line-height: 1.7;
}

.authority-bio-content ul li::before {
    content: "–";
    position: absolute;
    left: 0;
    color: var(--harvard-primary);
    font-weight: 700;
}

.authority-bio-content p {
    margin-bottom: 1rem;
    text-align: justify;
}

.authority-bio-content strong {
    color: var(--harvard-secondary);
    font-weight: 600;
}

/* Responsive Design */
@media (max-width: 968px) {
    .about-content-layout {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .about-image-container {
        max-width: 500px;
        margin: 0 auto;
    }

    .authority-profile-layout {
        grid-template-columns: 1fr;
        min-height: auto;
    }

    .authority-image-section {
        border-right: none;
        border-bottom: 3px solid var(--harvard-primary);
        padding: 2rem;
    }

    .authority-info-section {
        padding: 2rem;
    }
}

@media (max-width: 768px) {
    .about-page-header {
        padding: 6rem 0 2rem;
    }
    
    .about-page-title {
        font-size: 2rem;
    }
    
    .about-box {
        padding: 2rem 1.5rem;
    }
    
    .section-title {
        font-size: 1.6rem;
    }
    
    .section-subtitle {
        font-size: 1.3rem;
    }
    
    .team-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .authority-profile-image {
        max-width: 280px;
    }

    .authority-name {
        font-size: 1.2rem;
    }

    .authority-position {
        font-size: 1rem;
    }

    .authority-bio-content {
        font-size: 1rem;
    }

    .authority-bio-content h3,
    .authority-bio-content h4 {
        font-size: 1.2rem;
    }
}
</style>
