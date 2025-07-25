Finance Department Workflow & Pages

1. Login Page
Purpose: Authenticate finance staff.

Features:

Email/username and password input.

Forgot password/reset functionality.

Role-based access control (only finance users can proceed).

Secure session/token handling.

URL: /finance/login

2. Dashboard (Home Page)
Purpose: Overview of financial performance and shortcuts to key actions.

Features:

Total revenue collected (today, week, month).

Top-performing tax types.

Outstanding dues by tax type/zone.

Quick links: “Create Tax Type”, “View Businesses”, “Assign Taxes”.

URL: /finance/dashboard

3. Tax Types Management
Purpose: Create and manage all taxes that the municipality imposes.

Pages:
a) View All Tax Types

List of all existing tax types with search/filter.

Columns: Tax Name, Purpose, Frequency, Amount, Created Date, Status.

URL: /finance/taxes

b) Add New Tax Type

Fields: Name, Purpose, Amount, Frequency (daily, weekly, monthly, yearly).

Optional: Link to a business category or location.

URL: /finance/taxes/new

c) Edit Tax Type

Modify tax attributes if necessary.

Show impact of changes (e.g., businesses affected).

URL: /finance/taxes/edit/:id

4. Business Registry
Purpose: View and manage all registered businesses.

Features:

Search by name, TIN, phone, category, or area.

See business details: contact, location, category, assigned taxes, payment summary.

Action: Assign new taxes to business (modal or new page).

URL: /finance/businesses

→ Sub-page: /finance/businesses/view/:id

5. Tax Assignment Page
Purpose: Assign one or more existing tax types to a selected business.

Features:

Select from available tax types.

Define start date.

Set if tax is active or inactive.

Confirmation of assignment.

URL: /finance/businesses/assign-tax/:business_id

6. Revenue Analytics
Purpose: Visual insight into collections.

Features:

Revenue by tax type, by area, by collector.

Trend lines (daily/monthly/yearly).

Delinquency rates.

Export to PDF/Excel.

URL: /finance/reports

7. Payment Logs
Purpose: View all payment transactions.

Features:

Filter by business, date range, collector, or tax type.

View: Amount, date, payment mode, status, receipt.

Export logs.

URL: /finance/payments

8. Notifications Center
Purpose: Manage alerts and reminders sent to businesses.

Features:

Send manual notices (SMS/email) to specific businesses.

View logs of automated reminders.

Configure timing and content of auto-notifications.

URL: /finance/notifications

9. Settings & Profile
Purpose: Update user info and finance department settings.

Features:

Change password.

Manage two-factor authentication.

Notification preferences.

View activity logs (for audit trail).

URL: /finance/settings

Optional Extras:

Audit Logs Page (for security & traceability).

Collector Performance Page (overview of collections per tax collector).

Export Center (download CSV, PDF reports).
