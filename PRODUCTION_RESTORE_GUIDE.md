# Quick Production Restore Guide

## Step 1: Commit & Push from Local (on your Mac)

```bash
# In your local directory
cd /Users/wiredtechie/Desktop/anthem-public-school

# Add the restored files
git add disclosure.php sports.php slc.php bus-routes.php fee-structure.php includes/header.php

# Commit the changes
git commit -m "fix: Restore new pages and fix header padding"

# Push to remote
git push origin main
```

## Step 2: Pull on Production (in your SSH session)

```bash
# You're already SSH'd in, so run:
cd domains/antheminternationalschool.com/public_html

# Backup current state (optional but recommended)
git stash

# Pull the latest changes
git pull origin main

# If there are conflicts, force pull:
# git fetch origin
# git reset --hard origin/main
```

## Step 3: Verify Files Exist

```bash
# Check if files are there and have content
ls -lh disclosure.php sports.php slc.php bus-routes.php fee-structure.php

# Quick check first few lines
head -3 disclosure.php
```

## Step 4: Set Proper Permissions

```bash
# Make sure files are readable
chmod 644 disclosure.php sports.php slc.php bus-routes.php fee-structure.php
chmod 644 includes/header.php

# Create upload directories if they don't exist
mkdir -p uploads/disclosure uploads/sports
chmod 755 uploads/disclosure uploads/sports
```

## Step 5: Import Database (if not done already)

```bash
# Check if tables exist first
mysql -u u532478260_testanthm -p u532478260_testanthm -e "SHOW TABLES LIKE '%bus_routes%';"

# If table doesn't exist, import the SQL
mysql -u u532478260_testanthm -p u532478260_testanthm < database_additions.sql
```

---

## Alternative: Direct File Upload (If Git doesn't work)

If git pull doesn't work, you can upload files directly via SSH:

### From your Mac terminal (NEW terminal, not the SSH one):

```bash
cd /Users/wiredtechie/Desktop/anthem-public-school

# Upload all 5 pages
scp -P 65002 disclosure.php sports.php slc.php bus-routes.php fee-structure.php \
  u532478260@193.203.185.161:domains/antheminternationalschool.com/public_html/

# Upload updated header
scp -P 65002 includes/header.php \
  u532478260@193.203.185.161:domains/antheminternationalschool.com/public_html/includes/

# Upload database SQL
scp -P 65002 database_additions.sql \
  u532478260@193.203.185.161:domains/antheminternationalschool.com/public_html/
```

Then in SSH terminal, run:
```bash
# Import database
mysql -u u532478260_testanthm -p u532478260_testanthm < database_additions.sql
```

---

## Quick Test Commands (Run in SSH)

```bash
# 1. Verify files exist and have content
for file in disclosure.php sports.php slc.php bus-routes.php fee-structure.php; do
  echo "=== $file ==="
  ls -lh $file
  head -2 $file
  echo ""
done

# 2. Check database tables
mysql -u u532478260_testanthm -p u532478260_testanthm -e "
USE u532478260_testanthm;
SHOW TABLES LIKE 'disclosure%';
SHOW TABLES LIKE 'sports';
SHOW TABLES LIKE 'bus_routes';
SHOW TABLES LIKE 'fee_structure';
SHOW TABLES LIKE 'school_leaving%';
"

# 3. Test page access (should return PHP code, not 404)
curl -I https://antheminternationalschool.com/disclosure.php
```

---

## Troubleshooting

### If pages show 404:
```bash
# Check .htaccess rewrite rules
cat .htaccess | grep -i rewrite

# Make sure mod_rewrite is not blocking .php files
```

### If pages are blank:
```bash
# Check PHP errors
tail -50 /home/u532478260/logs/error_log

# Or enable error display temporarily
echo "<?php error_reporting(E_ALL); ini_set('display_errors', 1); ?>" > test_errors.php
```

### If database errors appear:
```bash
# Re-import database
mysql -u u532478260_testanthm -p u532478260_testanthm < database_additions.sql

# Verify tables were created
mysql -u u532478260_testanthm -p u532478260_testanthm -e "SHOW TABLES;"
```

---

## What I Recommend (Fastest):

**Do Option 1 (Git method)** - Just run these commands:

```bash
# On LOCAL Mac terminal:
cd /Users/wiredtechie/Desktop/anthem-public-school
git add disclosure.php sports.php slc.php bus-routes.php fee-structure.php includes/header.php
git commit -m "fix: Restore pages and fix header"
git push origin main

# Then in your EXISTING SSH session:
cd domains/antheminternationalschool.com/public_html
git pull origin main
chmod 644 *.php
chmod 755 uploads/disclosure uploads/sports 2>/dev/null || mkdir -p uploads/disclosure uploads/sports && chmod 755 uploads/disclosure uploads/sports
```

That's it! The pages should work now.
