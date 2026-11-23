# Backend

Backend for the Visitor Management System (SecureGate).

## Structure

- `config/database.php` — MySQL connection (`visitors-management-system` database)
- `includes/` — shared PHP includes: auth, sessions, header, navbar, sidebar, footer
- `api/visitor_book.php` — JSON endpoint returning the visitor log for the admin dashboard

The client form and admin dashboard both connect to the same MySQL database, so visitor registrations are shared automatically.
