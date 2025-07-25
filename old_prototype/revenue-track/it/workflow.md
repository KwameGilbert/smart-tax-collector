IT Department Dashboard Workflow & Pages

1. Login Page
Purpose: Authenticate IT personnel securely.

Features:

Email/username and password fields

Two-factor authentication (optional)

Forgot password/reset option

Role-based access control (only IT department users can proceed)

Secure session/token management

URL: /it/login

2. Dashboard (Home Page)
Purpose: Provide a system-wide overview and shortcuts to critical IT tasks.

Features:

System uptime/health status

API and server response times

Error logs overview

Active users and sessions

Quick links: “Manage Users”, “Logs”, “Backups”, “Security Settings”

URL: /it/dashboard

3. User & Role Management
Purpose: Create and manage users and their permissions.

Pages:
a) View All Users

List of all users (collectors, finance, RCD, MCE)

Columns: Name, Email, Role, Status (active/inactive), Last Login

Filters: by role, status

URL: /it/users

b) Add/Edit User

Fields: Name, Email, Password, Role (dropdown: finance, collector, etc.), Status

Role-based permissions assignment

Optional 2FA toggle

URL: /it/users/new
URL: /it/users/edit/:id

4. System Monitoring
Purpose: Monitor platform uptime, traffic, and error reports.

Features:

Live system metrics (CPU, memory, uptime)

Logs of failed logins, API errors, system exceptions

Downtime reports

Alerts configuration (e.g., get notified on service failures)

URL: /it/monitoring

5. Security Center
Purpose: Manage authentication, access policies, and audit trails.

Features:

Configure authentication (password policies, 2FA enforcement)

Role-based access control settings

Session management (force logout, timeout rules)

IP whitelisting/blacklisting

Firewall settings (optional)

URL: /it/security

6. Audit Logs Page
Purpose: Maintain accountability and track system-level actions.

Features:

Full logs of logins, role changes, tax modifications, payments, etc.

Filters: user, action type, date range

Export logs (PDF, CSV)

Immutable logs (tamper-proof)

URL: /it/audit-logs

7. Backup & Restore
Purpose: Ensure data resilience with scheduled and manual backups.

Features:

Schedule daily/weekly full backups

Manual backup trigger

List of backup versions with date/size/status

Restore option from any version

Storage destination (local/cloud)

URL: /it/backups

8. Support Ticket Management
Purpose: Handle support requests from staff (Finance, Collector, RCD).

Features:

View all open/resolved tickets

Assign ticket to IT staff

Communicate with ticket sender (comments, resolution updates)

Track status: Open, In Progress, Resolved, Closed

URL: /it/support-tickets
→ Sub-page: /it/support-tickets/view/:id

9. System Configuration Page
Purpose: Manage environment variables and platform-wide settings.

Features:

Configure SMTP (for emails), SMS gateway (for notifications)

Manage environment variables: API keys, Paystack integration, etc.

System timezone, locale, currency, etc.

URL: /it/system-settings

10. Activity Logs (Personal)
Purpose: IT staff can view their own actions and trace changes.

Features:

Actions performed (e.g., edited user, restored backup)

Timestamps

IP address, location (optional)

URL: /it/my-activity

Optional Extras:

API Key Management: For enabling integrations with third-party tools → /it/api-keys

Deployment Panel: Push updates, monitor build status (if CI/CD integrated)

SMS & Email Delivery Reports: Track notification delivery success rates
