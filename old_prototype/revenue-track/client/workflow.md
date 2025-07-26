Client Dashboard Workflow & Pages

1. Login Page
Purpose: Authenticate citizens and business owners securely.

Features:

Email/phone number and password input

“Forgot Password” recovery

Role-based access control (only clients can proceed)

Secure session/token handling

Redirect to dashboard upon successful login

URL: /client/login

2. Registration Page
Purpose: Allow citizens or business owners to sign up for an account.

Features:

Select account type: Individual or Business

Input: Name, phone, email, password, (for business: business name, category, registration ID)

Phone/email verification (OTP optional)

Automatic linking with registered tax profile (if it exists)

URL: /client/register

3. Dashboard (Home Page)
Purpose: Provide a personalized overview of tax obligations and account status.

Features:

Welcome message with user name/business name

List of assigned taxes with:
• Tax type
• Next due date
• Amount due
• Status (Paid / Unpaid / Overdue)

Quick Actions: Pay Now, View Payment History, View Receipts

URL: /client/dashboard

4. Tax Details Page
Purpose: Display detailed info about each assigned tax.

Features:

Tax name, purpose, frequency

Payment history for this tax

Status by month (e.g., Jan ✅, Feb ✅, Mar ❌, Apr ❌)

Estimated due amount till present

Pay Now button (with prefilled breakdown)

URL: /client/taxes/:tax_id

5. Make Payment Page
Purpose: Enable users to pay their dues securely.

Features:

Payment breakdown: months unpaid × amount

Choose payment method:
• Mobile Money (MTN, Vodafone, AirtelTigo)
• Debit/Credit Card
• USSD (optional redirect or shortcode info)

Payment handled through Paystack

Upon success: save transaction, send SMS/email, generate receipt

URL: /client/pay/:tax_id

6. Receipts Page
Purpose: View and download receipts for past payments.

Features:

Filter by date, tax type

Show each receipt with:
• Amount
• Date
• Payment method
• QR code for verification
• Download/Print button

URL: /client/receipts

→ Receipt View: /client/receipts/view/:payment_id

7. Payment History Page
Purpose: Comprehensive timeline of all payments made.

Features:

Table view: Tax name, amount, date, method, status

Filters: date range, tax type

Totals by year/month

Export to PDF/Excel

URL: /client/payments

8. Notifications Page
Purpose: View and manage tax-related alerts.

Features:

Inbox of SMS/email messages: reminders, confirmations, system alerts

Mark as read/unread

Notification preferences: opt in/out of email or SMS

URL: /client/notifications

9. Profile & Settings
Purpose: Allow users to update their personal or business information.

Features:

Edit: phone, email, password

View assigned taxes

Business-only: update registration ID, category

Enable/disable 2FA (optional)

URL: /client/profile

Optional Extras:

Support Page (submit inquiries or complaints) → /client/support

Help Center (FAQs, how-to guides) → /client/help

Account Verification Page (link or verify existing tax profile) → /client/verify-account