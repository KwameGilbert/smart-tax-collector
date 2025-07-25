Tax Collector Dashboard Workflow & Pages

1. Login Page
Purpose: Authenticate tax collectors securely.

Features:

Email/collector ID and password input

“Forgot Password” functionality

Role-based access control (only collectors can proceed)

Secure session/token handling

URL: /collector/login

2. Dashboard (Home Page)
Purpose: Provide a summary of the collector’s activities and access to core tools.

Features:

Total collections (today, week, month)

Number of businesses visited

Quick stats: most collected tax types, top areas

Shortcuts: “Search Business”, “Start Collection”, “My Performance”

URL: /collector/dashboard

3. Search Business Page
Purpose: Allow collectors to look up registered businesses in real-time.

Features:

Search by: Business Name, Registration ID, Phone Number

Display: Name, contact, category, area

Quick access to assigned taxes and payment status

URL: /collector/search

→ Sub-page: /collector/business/view/:business_id

4. Collection Page
Purpose: Process tax collection from a selected business.

Features:

Display all taxes assigned to business

Show for each tax:
• Name, Purpose
• Amount
• Frequency
• Periods due (auto-calculated based on last payment date & frequency)

Collector selects periods to pay (e.g., Jan–Apr)

System calculates total

Payment Integration:

Choose payment method:
• Mobile Money (MTN, Vodafone, AirtelTigo)
• Debit/Credit Card

Paystack handles transaction

On success:
• Record is saved
• Receipt is generated (SMS, email, QR code)
• Option to print via portable/thermal printer

URL: /collector/collect/:business_id

5. Receipt Page
Purpose: View or reprint the most recent receipts.

Features:

View receipt summary with QR code

Buttons to print or resend via SMS/email

URL: /collector/receipt/:payment_id

6. My Collections Page
Purpose: View collector’s full history of payments collected.

Features:

Filter by date range, tax type, business

Show: Business Name, Tax Name, Amount, Date, Method

Totals and summaries (per day/month)

Export to PDF/Excel

URL: /collector/collections

7. Performance Tracking Page
Purpose: Allow collectors to view their own productivity and targets.

Features:

Metrics:
• Total revenue collected
• Number of businesses served
• Breakdown by tax type, area

Leaderboard (optional): Compare performance to other collectors

Graphs: Daily/weekly trends

URL: /collector/performance


9. Settings & Profile
Purpose: Manage personal account and preferences.

Features:

Change password

Set notification preferences

View activity logs (security)

URL: /collector/settings

Optional Extras:

Business Visit Log: Record non-payment visits or feedback → /collector/visit-log

Complaint Logging: Collect complaints from businesses → /collector/report-issue

Support Chat: Direct helpdesk messaging → /collector/support
