Telegram Bot Notification Hook for WHMCS

This WHMCS hook sends automated notifications to Telegram using a bot. It is designed to notify administrators or customers about important WHMCS lifecycle events such as new orders, invoice payments, service terminations, etc. The message content is customizable and the hook can be easily extended to support more events.

Features:

Send instant notifications via Telegram bot

Supports multiple WHMCS lifecycle event triggers

Easy to configure and customize

Lightweight and clean code structure

Requirements:

WHMCS 8.x or higher

PHP 7.4 or higher

Telegram Bot Token and Chat ID

Installation and Configuration:

Upload the file to: /includes/hooks/

Open the file and set your Telegram Bot Token and Chat ID in the configuration section

Save the file, no further setup required

Supported Events (can be extended):

New Order Created

Invoice Paid

Service Terminated

Client Registration

License:
MIT License — free for personal and commercial usage.

Contribution:
Pull requests and improvement suggestions are welcome.

RADIUS Data Cleanup Hook for WHMCS (Dracula Servers)

This WHMCS hook clears FreeRADIUS accounting data when a service is terminated in WHMCS. It prevents outdated traffic data from remaining in the database and ensures accurate traffic usage tracking for future services.

Features:

Automatically clears RADIUS traffic data on service termination

Works with common FreeRADIUS accounting tables

Helps maintain clean and accurate database records

Fully automated with no admin action required

Requirements:

WHMCS 8.x or higher

PHP 7.4 or higher

A FreeRADIUS server and database connection

Accounting enabled in FreeRADIUS

Installation and Configuration:

Upload the file to: /includes/hooks/

Edit the database connection details inside the hook file (hostname, username, password, database name, and table names if necessary)

Once saved, the hook will automatically run when a product is terminated in WHMCS

Supported Action:

Service Termination triggers RADIUS accounting cleanup

Notes:

It is recommended to back up the RADIUS database before first deployment

Ensure table names match your FreeRADIUS schema

License:
MIT License — free for modification and redistribution.

Contribution:
Issues, optimization suggestions, and pull requests are appreciated.
