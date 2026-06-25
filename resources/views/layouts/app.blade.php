<!DOCTYPE html>
<html>

<head>
    <title>Mini Issue Tracker</title>
    <meta charset="utf-8">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        .topbar {
            background: #111827;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar a {
            color: white;
            text-decoration: none;
            margin-left: 18px;
        }

        .container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .page-actions {
            margin-bottom: 20px;
        }

        .btn,
        button {
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 9px 14px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-light {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-danger {
            background: #dc2626;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #f9fafb;
            color: #374151;
            font-size: 13px;
            text-align: left;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        input,
        textarea,
        select {
            width: 100%;
            max-width: 520px;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            margin-top: 6px;
        }

        textarea {
            min-height: 90px;
        }

        label {
            font-weight: bold;
            font-size: 14px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: flex-end;
            white-space: nowrap;
        }


        .actions form {
            margin: 0;
        }



        .action-btn:hover {
            transform: translateY(-2px);
        }

        .btn-light {
            background: transparent;
            color: #2563eb;
            padding: 0;
            border: none;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-light {
            background: #e5e7eb;
            color: #111827;
            padding: 9px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            border: none;
            padding: 9px 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-danger:hover {
            background: #dc2626;
        }



        .action-btn {
            min-width: auto;
            height: auto;
            padding: 8px 12px;
        }

        .tag-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tag-option {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 999px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .tag-selected {
            background: #dbeafe;
            border-color: #2563eb;
            color: #1d4ed8;
        }

        .tag-page {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 24px;
        }

        .tag-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 22px;
        }

        .tag-card form {
            display: grid;
            gap: 12px;
        }

        .tag-search {
            display: flex;
            gap: 10px;
            margin-bottom: 18px;
        }

        .tag-search input {
            max-width: none;
        }

        .tag-list {
            display: grid;
            gap: 10px;
        }

        .tag-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            border: 1px solid #e5e7eb;
            padding: 12px 14px;
            border-radius: 10px;
        }

        .tag-color {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
        }

        .color-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: inline-block;
        }

        .comment-form {
            display: grid;
            gap: 12px;
            max-width: 600px;
            margin-bottom: 20px;
        }

        .comment-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 12px;
        }


        .btn-secondary {
            display: inline-block;
            background: #e5e7eb;
            color: #111827;
            padding: 9px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: #d1d5db;
            transform: translateY(-1px);
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }


        .selection-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 12px;
            margin-bottom: 24px;
        }

        .selection-item {
            position: relative;
        }

        .selection-item input {
            display: none;
        }

        .selection-item span {
            display: inline-block;
            padding: 10px 18px;
            border: 1px solid #d1d5db;
            border-radius: 999px;
            background: #fff;
            cursor: pointer;
            transition: all .2s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .selection-item span:hover {
            border-color: #2563eb;
            color: #2563eb;
        }

        .selection-item input:checked+span {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 12px;
            margin: 2px;
        }

        .muted {
            color: #6b7280;
            font-size: 13px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: hidden;
        }

        .issue-table {
            width: 100%;
            table-layout: fixed;
        }



        .issue-table .title-col {
            width: 16%;
        }

        .issue-table .project-col {
            width: 15%;
        }

        .issue-table .status-col {
            width: 11%;
        }

        .issue-table .users-col {
            width: 18%;
        }

        .issue-table .priority-col {
            width: 9%;
        }

        .issue-table .date-col {
            width: 12%;
            white-space: nowrap;
        }

        .issue-table .actions-col {
            width: 19%;
        }

        .user-badge {
            display: inline-block;
            background: #eef2ff;
            color: #3730a3;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 12px;
            margin: 2px;
        }

        #comment-errors {
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 10px;
        }

        #comment-errors div {
            margin-bottom: 4px;
        }
    </style>
</head>

<body>

    <div class="topbar">
        <strong>Mini Issue Tracker</strong>

        <div>
            <a href="{{ route('projects.index') }}">Projects</a>
            <a href="{{ route('issues.index') }}">Issues</a>
            <a href="{{ route('tags.index') }}">Tags</a>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <div class="card">
            @yield('content')
        </div>
    </div>

</body>

</html>