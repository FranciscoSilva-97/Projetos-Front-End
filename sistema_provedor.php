<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetConnect Pro - Sistema Completo para Provedores</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --info-color: #17a2b8;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --sidebar-width: 280px;
            --header-height: 70px;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            --gradient-success: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
        }
        
        /* Layout Principal */
        .app-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Moderna */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--gradient-primary);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition);
            z-index: 1000;
            box-shadow: 3px 0 20px rgba(0,0,0,0.1);
        }
        
        .sidebar-header {
            padding: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        
        .logo i {
            color: #fff;
            font-size: 28px;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
        }
        
        .menu-item {
            margin-bottom: 8px;
            position: relative;
        }
        
        .menu-item a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: var(--transition);
            border-left: 4px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .menu-item a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }
        
        .menu-item a:hover::before {
            left: 100%;
        }
        
        .menu-item a:hover, .menu-item a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: #fff;
            transform: translateX(5px);
        }
        
        .menu-item i {
            width: 25px;
            font-size: 18px;
            margin-right: 15px;
            transition: var(--transition);
        }
        
        .menu-item a:hover i {
            transform: scale(1.1);
        }
        
        .menu-badge {
            background: var(--danger-color);
            color: white;
            border-radius: 12px;
            padding: 4px 10px;
            font-size: 11px;
            margin-left: auto;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
        }
        
        /* Conteúdo Principal */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            background: transparent;
        }
        
        /* Header Moderno */
        .header {
            height: var(--header-height);
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .toggle-sidebar {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--primary-color);
            cursor: pointer;
            display: none;
            transition: var(--transition);
        }
        
        .toggle-sidebar:hover {
            color: var(--secondary-color);
            transform: rotate(90deg);
        }
        
        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            position: relative;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--secondary-color);
            border-radius: 2px;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }
        
        .user-menu:hover {
            background: rgba(52, 152, 219, 0.1);
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--gradient-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        /* Conteúdo da Página */
        .page-content {
            padding: 30px;
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Cards e Grids Modernos */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }
        
        .stat-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--box-shadow);
            border-left: 5px solid var(--secondary-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-secondary);
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .stat-card.primary { border-left-color: var(--primary-color); }
        .stat-card.success { border-left-color: var(--success-color); }
        .stat-card.warning { border-left-color: var(--warning-color); }
        .stat-card.danger { border-left-color: var(--danger-color); }
        
        .stat-value {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
            background: var(--gradient-secondary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 12px;
            font-weight: 500;
        }
        
        .stat-change {
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }
        
        .stat-change.positive { color: var(--success-color); }
        .stat-change.negative { color: var(--danger-color); }
        
        /* Cards de Conteúdo Modernos */
        .card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.2);
            transition: var(--transition);
        }
        
        .card:hover {
            box-shadow: 0 8px 35px rgba(0,0,0,0.15);
        }
        
        .card-header {
            padding: 25px 30px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255,255,255,0.5);
        }
        
        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .card-title i {
            color: var(--secondary-color);
            font-size: 22px;
        }
        
        .card-actions {
            display: flex;
            gap: 12px;
        }
        
        .card-body {
            padding: 30px;
        }
        
        /* Tabelas Modernas */
        .table-responsive {
            overflow-x: auto;
            border-radius: var(--border-radius);
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        
        .table th, .table td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .table th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: var(--primary-color);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table tr {
            transition: var(--transition);
        }
        
        .table tr:hover {
            background: rgba(52, 152, 219, 0.03);
            transform: scale(1.01);
        }
        
        /* Badges e Status Modernos */
        .badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-success { 
            background: linear-gradient(135deg, var(--success-color), #2ecc71);
            color: white;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .badge-warning { 
            background: linear-gradient(135deg, var(--warning-color), #e67e22);
            color: white;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }
        
        .badge-danger { 
            background: linear-gradient(135deg, var(--danger-color), #c0392b);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .badge-info { 
            background: linear-gradient(135deg, var(--info-color), #2980b9);
            color: white;
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
        }
        
        .badge-primary { 
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            box-shadow: 0 4px 15px rgba(44, 62, 80, 0.3);
        }
        
        /* Botões Modernos */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            font-size: 14px;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary { 
            background: var(--gradient-secondary);
            color: white;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }
        
        .btn-success { 
            background: var(--gradient-success);
            color: white;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
        
        .btn-danger { 
            background: linear-gradient(135deg, var(--danger-color), #c0392b);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }
        
        .btn-warning { 
            background: linear-gradient(135deg, var(--warning-color), #e67e22);
            color: white;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }
        
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(243, 156, 18, 0.4);
        }
        
        .btn-outline { 
            background: transparent;
            border: 2px solid #ddd;
            color: #555;
        }
        
        .btn-outline:hover {
            background: #f8f9fa;
            border-color: var(--secondary-color);
            color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .btn-sm { padding: 10px 18px; font-size: 13px; }
        .btn-lg { padding: 16px 32px; font-size: 16px; }
        
        /* Formulários Modernos */
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
            background: rgba(255,255,255,0.9);
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            background: white;
        }
        
        /* Grid System */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }
        
        .col {
            flex: 1;
            padding: 0 15px;
        }
        
        .col-6 {
            flex: 0 0 50%;
            padding: 0 15px;
        }
        
        .col-4 {
            flex: 0 0 33.333%;
            padding: 0 15px;
        }
        
        .col-3 {
            flex: 0 0 25%;
            padding: 0 15px;
        }
        
        /* Alertas Modernos */
        .alert {
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .alert-success { 
            background: linear-gradient(135deg, rgba(39, 174, 96, 0.1), rgba(46, 204, 113, 0.1));
            color: #155724;
            border-left: 5px solid var(--success-color);
        }
        
        .alert-warning { 
            background: linear-gradient(135deg, rgba(243, 156, 18, 0.1), rgba(230, 126, 34, 0.1));
            color: #856404;
            border-left: 5px solid var(--warning-color);
        }
        
        .alert-danger { 
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.1), rgba(192, 57, 43, 0.1));
            color: #721c24;
            border-left: 5px solid var(--danger-color);
        }
        
        .alert-info { 
            background: linear-gradient(135deg, rgba(23, 162, 184, 0.1), rgba(41, 128, 185, 0.1));
            color: #0c5460;
            border-left: 5px solid var(--info-color);
        }
        
        /* Tabs Modernas */
        .tabs {
            display: flex;
            border-bottom: 2px solid rgba(0,0,0,0.05);
            margin-bottom: 25px;
            background: rgba(255,255,255,0.5);
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            padding: 0 20px;
        }
        
        .tab {
            padding: 18px 30px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            font-weight: 600;
            color: #6c757d;
            transition: var(--transition);
            position: relative;
        }
        
        .tab::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--secondary-color);
            transition: var(--transition);
            transform: translateX(-50%);
        }
        
        .tab.active {
            color: var(--secondary-color);
        }
        
        .tab.active::after {
            width: 100%;
        }
        
        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease-out;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Modal Moderno */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(10px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 0.3s ease-out;
        }
        
        .modal.show {
            display: flex;
        }
        
        .modal-content {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius);
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.2);
            animation: modalSlideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .modal-header {
            padding: 25px 30px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255,255,255,0.5);
        }
        
        .modal-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #6c757d;
            transition: var(--transition);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-close:hover {
            background: rgba(0,0,0,0.05);
            color: var(--danger-color);
            transform: rotate(90deg);
        }
        
        .modal-body {
            padding: 30px;
        }
        
        .modal-footer {
            padding: 25px 30px;
            border-top: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            background: rgba(255,255,255,0.5);
        }
        
        /* Utilitários */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-success { color: var(--success-color); }
        .text-danger { color: var(--danger-color); }
        .text-warning { color: var(--warning-color); }
        .text-muted { color: #6c757d; }
        
        .mb-0 { margin-bottom: 0; }
        .mb-10 { margin-bottom: 10px; }
        .mb-20 { margin-bottom: 20px; }
        .mb-30 { margin-bottom: 30px; }
        
        .mt-10 { margin-top: 10px; }
        .mt-20 { margin-top: 20px; }
        .mt-30 { margin-top: 30px; }
        
        .hidden { display: none; }
        
        /* Status de Conexão Moderno */
        .connection-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-online {
            background: linear-gradient(135deg, var(--success-color), #2ecc71);
            color: white;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .status-offline {
            background: linear-gradient(135deg, var(--danger-color), #c0392b);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .status-suspended {
            background: linear-gradient(135deg, var(--warning-color), #e67e22);
            color: white;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }
        
        /* Filtros Modernos */
        .filters {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            padding: 25px;
            border-radius: var(--border-radius);
            margin-bottom: 25px;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: var(--box-shadow);
        }
        
        .filter-group {
            display: flex;
            gap: 20px;
            align-items: end;
            flex-wrap: wrap;
        }
        
        /* Paginação Moderna */
        .pagination {
            display: flex;
            list-style: none;
            gap: 8px;
            margin-top: 25px;
            justify-content: center;
        }
        
        .page-item {
            display: inline-block;
        }
        
        .page-link {
            display: block;
            padding: 12px 18px;
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            color: var(--secondary-color);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 600;
        }
        
        .page-link:hover {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .page-item.active .page-link {
            background: var(--gradient-secondary);
            color: white;
            border-color: var(--secondary-color);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        /* Loading Moderno */
        .loading {
            display: inline-block;
            width: 24px;
            height: 24px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--secondary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Cards de Plano Modernos */
        .plan-card {
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            padding: 0;
            transition: var(--transition);
            height: 100%;
            background: white;
            overflow: hidden;
            position: relative;
        }
        
        .plan-card:hover {
            border-color: var(--secondary-color);
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .plan-card.featured {
            border-color: var(--secondary-color);
            position: relative;
            overflow: hidden;
            transform: scale(1.05);
        }
        
        .plan-card.featured::before {
            content: 'MAIS POPULAR';
            position: absolute;
            top: 20px;
            right: -35px;
            background: var(--gradient-secondary);
            color: white;
            padding: 8px 40px;
            font-size: 12px;
            font-weight: 700;
            transform: rotate(45deg);
            z-index: 2;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        .plan-header {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }
        
        .plan-name {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary-color);
        }
        
        .plan-price {
            font-size: 42px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .plan-period {
            color: #6c757d;
            font-size: 14px;
            font-weight: 500;
        }
        
        .plan-features {
            padding: 30px;
            list-style: none;
        }
        
        .plan-features li {
            padding: 12px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .plan-features li:last-child {
            border-bottom: none;
        }
        
        .plan-features li i.fa-check {
            color: var(--success-color);
            font-size: 16px;
        }
        
        .plan-features li i.fa-times {
            color: var(--danger-color);
            font-size: 16px;
        }
        
        /* Search Box Moderno */
        .search-box {
            position: relative;
            flex: 1;
        }
        
        .search-box input {
            padding-left: 45px;
            background: rgba(255,255,255,0.9);
        }
        
        .search-box i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 16px;
        }
        
        /* Action Buttons Modernos */
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .action-buttons .btn {
            padding: 8px 12px;
        }
        
        /* Charts Placeholder Moderno */
        .chart-placeholder {
            height: 300px;
            background: linear-gradient(45deg, #f8f9fa 25%, transparent 25%), 
                        linear-gradient(-45deg, #f8f9fa 25%, transparent 25%), 
                        linear-gradient(45deg, transparent 75%, #f8f9fa 75%), 
                        linear-gradient(-45deg, transparent 75%, #f8f9fa 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-weight: 600;
            border: 2px dashed #e9ecef;
        }
        
        /* Responsividade */
        @media (max-width: 1200px) {
            .col-3 {
                flex: 0 0 50%;
            }
        }
        
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .toggle-sidebar {
                display: block;
            }
            
            .col, .col-6, .col-4, .col-3 {
                flex: 0 0 100%;
                margin-bottom: 20px;
            }
            
            .filter-group {
                flex-direction: column;
                align-items: stretch;
            }
            
            .header-right {
                gap: 15px;
            }
        }
        
        @media (max-width: 768px) {
            .page-content {
                padding: 20px;
            }
            
            .header {
                padding: 0 20px;
            }
            
            .card-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .card-actions {
                width: 100%;
                justify-content: flex-end;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-bolt"></i>
                    <span>NetConnect Pro</span>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="#" class="active" data-page="dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" data-page="cobrancas">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Cobranças</span>
                        <span class="menu-badge">3</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" data-page="clientes">
                        <i class="fas fa-users"></i>
                        <span>Clientes</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" data-page="planos">
                        <i class="fas fa-cubes"></i>
                        <span>Planos</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" data-page="financeiro">
                        <i class="fas fa-chart-line"></i>
                        <span>Financeiro</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" data-page="relatorios">
                        <i class="fas fa-chart-bar"></i>
                        <span>Relatórios</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" data-page="suporte">
                        <i class="fas fa-headset"></i>
                        <span>Suporte</span>
                        <span class="menu-badge">5</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" data-page="configuracoes">
                        <i class="fas fa-cogs"></i>
                        <span>Configurações</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Conteúdo Principal -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="header-left">
                    <button class="toggle-sidebar" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title" id="pageTitle">Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                        <span class="menu-badge">7</span>
                    </div>
                    <div class="user-menu">
                        <div class="user-avatar">AD</div>
                        <div class="user-info">
                            <div class="user-name">Admin</div>
                            <div class="user-role">Administrador</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Conteúdo da Página -->
            <div class="page-content">
                
                <!-- Dashboard -->
                <div id="page-dashboard" class="page">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-value">R$ 15.420,50</div>
                            <div class="stat-label">Recebido este mês</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                12.5% vs mês anterior
                            </div>
                        </div>
                        <div class="stat-card success">
                            <div class="stat-value">1.245</div>
                            <div class="stat-label">Clientes ativos</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                8 novos este mês
                            </div>
                        </div>
                        <div class="stat-card warning">
                            <div class="stat-value">R$ 8.750,00</div>
                            <div class="stat-label">Pendente</div>
                            <div class="stat-change negative">
                                <i class="fas fa-arrow-down"></i>
                                3.2% de inadimplência
                            </div>
                        </div>
                        <div class="stat-card danger">
                            <div class="stat-value">25</div>
                            <div class="stat-label">Clientes cortados</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-down"></i>
                                5% menos que mês anterior
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        <i class="fas fa-chart-line"></i>
                                        Receitas Mensais
                                    </h2>
                                </div>
                                <div class="card-body">
                                    <div class="chart-placeholder">
                                        <i class="fas fa-chart-line" style="font-size: 48px; margin-right: 15px;"></i>
                                        Gráfico de Receitas Mensais
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        <i class="fas fa-chart-pie"></i>
                                        Distribuição de Planos
                                    </h2>
                                </div>
                                <div class="card-body">
                                    <div class="chart-placeholder">
                                        <i class="fas fa-chart-pie" style="font-size: 48px; margin-right: 15px;"></i>
                                        Gráfico de Distribuição
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        <i class="fas fa-history"></i>
                                        Últimas Cobranças
                                    </h2>
                                    <div class="card-actions">
                                        <button class="btn btn-primary" onclick="showModal('newPaymentModal')">
                                            <i class="fas fa-plus"></i>
                                            Nova Cobrança
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Valor</th>
                                                    <th>Vencimento</th>
                                                    <th>Status</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>João Silva</strong><br>
                                                        <small class="text-muted">(11) 99999-9999</small>
                                                    </td>
                                                    <td>R$ 89,90</td>
                                                    <td>10/05/2023</td>
                                                    <td><span class="badge badge-success">Pago</span></td>
                                                    <td>
                                                        <div class="action-buttons">
                                                            <button class="btn btn-sm btn-outline" title="Visualizar">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline" title="Reenviar">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Maria Santos</strong><br>
                                                        <small class="text-muted">(11) 88888-8888</small>
                                                    </td>
                                                    <td>R$ 129,90</td>
                                                    <td>12/05/2023</td>
                                                    <td><span class="badge badge-warning">Pendente</span></td>
                                                    <td>
                                                        <div class="action-buttons">
                                                            <button class="btn btn-sm btn-outline" title="Visualizar">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline" title="Reenviar">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">
                                        <i class="fas fa-plug"></i>
                                        Status de Conexão
                                    </h2>
                                </div>
                                <div class="card-body">
                                    <div class="chart-placeholder" style="height: 200px;">
                                        <i class="fas fa-signal" style="font-size: 36px; margin-right: 10px;"></i>
                                        Status de Conexão
                                    </div>
                                    <div class="mt-20 text-center">
                                        <span class="connection-status status-online mr-10">
                                            <i class="fas fa-circle"></i>
                                            70% Online
                                        </span>
                                        <span class="connection-status status-suspended mr-10">
                                            <i class="fas fa-circle"></i>
                                            20% Suspenso
                                        </span>
                                        <span class="connection-status status-offline">
                                            <i class="fas fa-circle"></i>
                                            10% Offline
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Outras páginas... -->

            </div>
        </div>
    </div>

    <!-- Modal Nova Cobrança -->
    <div class="modal" id="newPaymentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Nova Cobrança</h3>
                <button class="modal-close" onclick="hideModal('newPaymentModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="newPaymentForm">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Cliente</label>
                                <select class="form-control" required>
                                    <option value="">Selecione um cliente</option>
                                    <option value="1">João Silva</option>
                                    <option value="2">Maria Santos</option>
                                    <option value="3">Pedro Oliveira</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Plano</label>
                                <select class="form-control" required>
                                    <option value="">Selecione um plano</option>
                                    <option value="1">Básico - R$ 79,90</option>
                                    <option value="2">Intermediário - R$ 99,90</option>
                                    <option value="3">Avançado - R$ 129,90</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Data de Vencimento</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Tipo de Cobrança</label>
                                <div>
                                    <input type="radio" id="single" name="payment-type" value="single" checked>
                                    <label for="single">Cobrança Única</label>
                                    
                                    <input type="radio" id="installment" name="payment-type" value="installment" style="margin-left: 20px;">
                                    <label for="installment">Carnê (até 24 parcelas)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="installmentOptions" class="hidden">
                        <div class="form-group">
                            <label class="form-label">Número de Parcelas</label>
                            <select class="form-control">
                                <option value="2">2 parcelas</option>
                                <option value="3">3 parcelas</option>
                                <option value="6">6 parcelas</option>
                                <option value="12">12 parcelas</option>
                                <option value="24">24 parcelas</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" onclick="hideModal('newPaymentModal')">Cancelar</button>
                <button class="btn btn-primary">Gerar Cobrança</button>
            </div>
        </div>
    </div>

    <script>
        // Sistema de Navegação
        document.addEventListener('DOMContentLoaded', function() {
            setupNavigation();
            setupEventListeners();
            initializeComponents();
        });
        
        function setupNavigation() {
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    document.querySelectorAll('.sidebar-menu a').forEach(item => {
                        item.classList.remove('active');
                    });
                    
                    this.classList.add('active');
                    
                    const page = this.getAttribute('data-page');
                    document.getElementById('pageTitle').textContent = 
                        this.querySelector('span').textContent;
                    
                    navigateToPage(page);
                });
            });
            
            document.getElementById('toggleSidebar').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('show');
            });

            // Tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    const container = this.closest('.tabs');
                    
                    // Remove active class from all tabs and contents
                    container.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                    container.parentElement.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked tab and corresponding content
                    this.classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        }
        
        function setupEventListeners() {
            document.querySelectorAll('input[name="payment-type"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const installmentOptions = document.getElementById('installmentOptions');
                    if (this.value === 'installment') {
                        installmentOptions.classList.remove('hidden');
                    } else {
                        installmentOptions.classList.add('hidden');
                    }
                });
            });
            
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('modal')) {
                    e.target.classList.remove('show');
                }
            });

            // Select all checkbox
            document.getElementById('selectAll')?.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.payment-checkbox');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        }
        
        function initializeComponents() {
            console.log("Sistema inicializado com layout moderno");
            
            // Simular carregamento de dados
            setTimeout(() => {
                showNotification('Sistema carregado com sucesso!', 'success');
            }, 1000);
        }
        
        function navigateToPage(page) {
            document.querySelectorAll('.page').forEach(pageEl => {
                pageEl.classList.add('hidden');
            });
            
            document.getElementById(`page-${page}`).classList.remove('hidden');
            
            if (window.innerWidth < 992) {
                document.getElementById('sidebar').classList.remove('show');
            }
        }
        
        function showModal(modalId) {
            document.getElementById(modalId).classList.add('show');
        }
        
        function hideModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        // Sistema de Notificações
        function showNotification(message, type = 'info') {
            // Implementar sistema de notificações toast
            console.log(`[${type.toUpperCase()}] ${message}`);
        }
    </script>
</body>
</html>