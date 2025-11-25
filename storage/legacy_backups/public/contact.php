<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contacta con el Instituto Superior Tecnológico Sudamericano - Información de contacto y formulario">
    <title><?= $title ?? 'Contacto - ISTS' ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .contact-hero {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: var(--color-white);
            padding: 4rem 0;
            text-align: center;
        }
        
        .contact-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-family: var(--font-primary);
        }
        
        .contact-hero p {
            font-size: 1.25rem;
            opacity: 0.9;
        }
        
        .contact-section {
            padding: 4rem 0;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            margin-bottom: 4rem;
        }
        
        .contact-info {
            background-color: var(--color-white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .contact-info h3 {
            color: var(--color-primary);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: var(--color-light);
            border-radius: 8px;
            transition: var(--transition);
        }
        
        .contact-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .contact-icon {
            font-size: 1.5rem;
            color: var(--color-primary);
            width: 40px;
            text-align: center;
        }
        
        .contact-details h4 {
            color: var(--color-dark);
            margin-bottom: 0.25rem;
        }
        
        .contact-details p {
            color: var(--color-gray);
            margin: 0;
        }
        
        .contact-form {
            background-color: var(--color-white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--color-dark);
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--color-border);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(165, 28, 48, 0.1);
        }
        
        .form-control.error {
            border-color: var(--color-danger);
        }
        
        .form-control.success {
            border-color: var(--color-success);
        }
        
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }
        
        .btn-submit {
            background-color: var(--color-primary);
            color: var(--color-white);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
        }
        
        .btn-submit:hover {
            background-color: var(--color-secondary);
            transform: translateY(-2px);
        }
        
        .btn-submit:disabled {
            background-color: var(--color-gray);
            cursor: not-allowed;
            transform: none;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .alert-error {
            background-color: rgba(220, 53, 69, 0.1);
            border: 1px solid #dc3545;
            color: #dc3545;
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            border: 1px solid #28a745;
            color: #28a745;
        }
        
        .field-error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .map-section {
            background-color: var(--color-light);
            padding: 4rem 0;
        }
        
        .map-container {
            background-color: var(--color-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .map-placeholder {
            height: 400px;
            background: linear-gradient(45deg, #f0f0f0 25%, transparent 25%), 
                        linear-gradient(-45deg, #f0f0f0 25%, transparent 25%), 
