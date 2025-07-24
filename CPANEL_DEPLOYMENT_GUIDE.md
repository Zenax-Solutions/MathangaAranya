# 🚀 cPanel Deployment Guide - MathangaAranya Donation System

## 📋 **STEP-BY-STEP cPanel DEPLOYMENT**

### **Phase 1: Upload New Code**
1. Download/pull the latest code from GitHub
2. Upload to your cPanel file manager or via FTP
3. Make sure all files are in the correct directory structure

### **Phase 2: Database Migration**
Since your cPanel has the old database structure, you need to run these commands:

#### **2.1 Run Database Migrations**
```bash
# SSH into your cPanel or use cPanel Terminal
cd /path/to/your/laravel/project

# Run pending migrations to add new columns
php artisan migrate

# This will add:
# - next_reminder_date column
# - payment_completed column  
# - payment_date column
# - Other tracking columns
```

#### **2.2 Check Database State**
```bash
# Check if your database needs next_reminder_date populated
php artisan check:database-state
```

**Expected Output for Old Database:**
```
📊 Total Community Records: X
✅ Records WITH next_reminder_date: 0
❌ Records WITHOUT next_reminder_date: X
⚠️  X records need next_reminder_date populated!
```

#### **2.3 Populate Missing Data**
```bash
# Populate next_reminder_date for all existing users
php artisan migrate:populate-next-reminder-dates
```

**Expected Output:**
```
🔄 POPULATING NEXT REMINDER DATES FOR EXISTING USERS
Found X records that need next_reminder_date populated

✅ Updated ID 1: John Doe
   Program Date: 2024-01-15
   Next Reminder: 2025-08-15 (monthly)

📊 SUMMARY:
✅ Successfully updated: X records
❌ Errors encountered: 0 records
```

#### **2.4 Verify Everything is Working**
```bash
# Final check to ensure all data is populated
php artisan check:database-state
```

**Expected Output After Success:**
```
✅ Records WITH next_reminder_date: X
❌ Records WITHOUT next_reminder_date: 0
🎯 SYSTEM READY: YES ✅
```

### **Phase 3: Set Up Scheduler**
Your cPanel needs to run the Laravel scheduler for automatic reminders.

#### **3.1 Add Cron Job in cPanel**
1. Go to cPanel → **Cron Jobs**
2. Add a new cron job:
   - **Minute:** `*`
   - **Hour:** `*`
   - **Day:** `*`
   - **Month:** `*`  
   - **Weekday:** `*`
   - **Command:** `/usr/local/bin/php /path/to/your/project/artisan schedule:run >> /dev/null 2>&1`

**Replace `/path/to/your/project/` with your actual project path**

#### **3.2 Test Scheduler Manually**
```bash
# Test the scheduler manually
php artisan schedule:run

# Check logs to see if it's working
tail -f storage/logs/laravel.log
```

### **Phase 4: Final Configuration**

#### **4.1 Environment Setup**
Make sure your `.env` file has correct settings:
```env
APP_ENV=production
APP_DEBUG=false
MAIL_MAILER=smtp
# Your email configuration
DB_CONNECTION=mysql
# Your database configuration
```

#### **4.2 Cache and Optimize**
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔧 **TROUBLESHOOTING**

### **If next_reminder_date is still empty:**
```bash
# Force populate with verbose output
php artisan migrate:populate-next-reminder-dates --verbose

# Check specific user
php artisan tinker
>>> $user = App\Models\Community::find(1);
>>> echo $user->next_reminder_date;
```

### **If scheduler is not working:**
```bash
# Check if cron job path is correct
which php
# Use the output path in your cron job

# Test manually
php artisan schedule:list
php artisan schedule:run
```

### **If emails are not sending:**
```bash
# Test email configuration
php artisan tinker
>>> Mail::raw('test', function($msg) { $msg->to('test@example.com')->subject('test'); });
```

## ✅ **SUCCESS INDICATORS**

Your system is working correctly when:

1. **Database Check:** `php artisan check:database-state` shows all records have `next_reminder_date`
2. **Scheduler:** Cron job runs without errors  
3. **Logs:** `storage/logs/laravel.log` shows reminder scheduler running daily
4. **Admin Panel:** You can see `Next Reminder Date` column populated in community records
5. **Payment Links:** Users can access payment pages with proper popup messages

## 📞 **SUPPORT**

If you encounter issues:
1. Check `storage/logs/laravel.log` for error messages
2. Run `php artisan check:database-state` to verify data
3. Test manually with `php artisan schedule:run`
4. Verify cron job is set up correctly in cPanel

---

**🎯 After completing these steps, your MathangaAranya donation system will be fully operational on cPanel!**
