# GANG — Laravel 12 migrations

Copy the 13 PHP files into `database/migrations/` of a NEW Laravel 12 project, keeping the existing default users migration. Run `php artisan migrate`.

Tables: existing users (+ phone), super_admins, admins, sports, courts, subscriptions, bookings, group_games, game_players, waiting_list, payments, reviews, sms_logs.

Important:
- Payment relationships use UNIQUE nullable booking_id and subscription_id (one payment record per booking/subscription). MySQL CHECK enforces exactly one target.
- Payment status is added to make 'successful deposit before confirmed booking' possible.
- A booking requires at least one actor (user or admin). Group bookings can have an admin creator.
- Prevent overlapping court bookings using a transaction + locking in Laravel. A normal unique index cannot prevent overlapping time ranges.
- Confirm booking only after a successful deposit using transaction/application logic.
- Validate that subscription.admin_id equals booking court's admin_id in Laravel.
- Prevent duplicate ACTIVE waitlist requests for the same user/court/date/time using a transaction and lock; the normal index is NOT a partial unique constraint.
- Use Laravel queues/jobs for SMS offers, expiry after 15 minutes, and immediate next-in-line offers when another slot opens.
- Enforce start/end and price constraints in request validation/business logic as needed.
- Laravel's default users migration already creates users; do not duplicate it.
- Three separate login tables need corresponding authentication guards.
- If existing users table already contains phone, omit the first migration.
- No seeders are included. Seed the five sports separately.
- MySQL 8.0.16+ is recommended for CHECK enforcement; other database drivers may require different constraints.
