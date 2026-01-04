# Hostinger Deployment Guide - New Pages

## Overview
This guide will help you deploy the 5 new pages (Disclosure, Sports, SLC, Bus Routes, Fee Structure) to your Hostinger production server.

---

## Method 1: Using Hostinger File Manager (Recommended for Beginners)

### Step 1: Upload PHP Files

1. **Login to Hostinger hPanel**
   - Go to https://hpanel.hostinger.com
   - Login with your credentials

2. **Access File Manager**
   - Click on **File Manager** in the Files section
   - Navigate to `public_html` or your website root directory

3. **Upload New Pages**
   Upload these 5 files to your website root (same level as `index.php`):
   - `disclosure.php`
   - `sports.php`
   - `slc.php`
   - `bus-routes.php`
   - `fee-structure.php`

4. **Update Header File**
   - Navigate to `includes/` folder
   - **Backup** your current `header.php` first!
   - Upload the new `header.php` (this contains the dropdown menu)

### Step 2: Create Upload Directories

1. In File Manager, navigate to `uploads/` folder
2. Click **New Folder** and create:
   - `disclosure` (for document uploads)
   - `sports` (for sports images)
3. Set permissions to **755** for both folders (right-click → Permissions)

### Step 3: Update Database

1. **Access phpMyAdmin**
   - In hPanel, go to **Databases** → **phpMyAdmin**
   - Select your database from the left sidebar

2. **Run SQL Migration**
   - Click on **SQL** tab at the top
   - Open `database_additions.sql` from your local computer
   - Copy ALL the content
   - Paste it into the SQL query box
   - Click **Go** button

3. **Verify Tables Created**
   Check if these new tables exist:
   - `disclosure_documents`
   - `sports`
   - `school_leaving_certificates`
   - `bus_routes`
   - `fee_structure`

   You should see sample data in each table.

### Step 4: Test the Pages

Visit your website and test:
- https://yourwebsite.com/disclosure.php
- https://yourwebsite.com/sports.php
- https://yourwebsite.com/slc.php
- https://yourwebsite.com/bus-routes.php
- https://yourwebsite.com/fee-structure.php

Test the **More Info** dropdown in the navigation menu.

---

## Method 2: Using FTP (FileZilla)

### Step 1: Connect via FTP

1. **Get FTP Credentials**
   - In hPanel → Files → FTP Accounts
   - Note down: Hostname, Username, Password, Port (usually 21)

2. **Connect with FileZilla**
   - Download FileZilla if you don't have it
   - File → Site Manager → New Site
   - Enter your FTP credentials
   - Click Connect

### Step 2: Upload Files

1. **Navigate on Remote Server**
   - Go to `public_html/` or your website root

2. **Upload PHP Files**
   Drag and drop from local to remote:
   - `disclosure.php`
   - `sports.php`
   - `slc.php`
   - `bus-routes.php`
   - `fee-structure.php`

3. **Update Header**
   - Navigate to `includes/` folder
   - **Backup** `header.php` first (download it)
   - Upload new `header.php`

4. **Create Directories**
   - In `uploads/` folder, create:
     - `disclosure/`
     - `sports/`

### Step 3: Database Migration
Follow the same phpMyAdmin steps from Method 1.

---

## Method 3: Using Git (If You Have SSH Access)

```bash
# SSH into your server
ssh username@yourserver.com

# Navigate to your website directory
cd public_html

# Pull latest changes
git pull origin main

# Create upload directories
mkdir -p uploads/disclosure uploads/sports
chmod 755 uploads/disclosure uploads/sports

# Import database
mysql -u your_db_user -p your_db_name < database_additions.sql
```

---

## Post-Deployment Checklist

### ✅ Files Uploaded
- [ ] `disclosure.php`
- [ ] `sports.php`
- [ ] `slc.php`
- [ ] `bus-routes.php`
- [ ] `fee-structure.php`
- [ ] `includes/header.php` (updated)

### ✅ Directories Created
- [ ] `uploads/disclosure/` (permissions: 755)
- [ ] `uploads/sports/` (permissions: 755)

### ✅ Database Updated
- [ ] `disclosure_documents` table created
- [ ] `sports` table created
- [ ] `school_leaving_certificates` table created
- [ ] `bus_routes` table created
- [ ] `fee_structure` table created
- [ ] Sample data inserted

### ✅ Testing
- [ ] All 5 pages load without errors
- [ ] Navigation dropdown menu works
- [ ] Mobile menu shows new pages
- [ ] No 404 errors
- [ ] Design matches existing pages
- [ ] Database queries return sample data

---

## Troubleshooting

### Problem: Pages show 404 Error
**Solution**: 
- Check file names are exactly:
  - `disclosure.php` (not `Disclosure.php`)
  - `bus-routes.php` (not `bus_routes.php`)
- Clear browser cache and Hostinger cache

### Problem: Database errors
**Solution**:
- Verify database connection in `includes/config.php`
- Check if tables were created in phpMyAdmin
- Ensure column names match (case-sensitive in some databases)

### Problem: Images/Files not uploading
**Solution**:
```bash
# Set proper permissions
uploads/disclosure/   → 755
uploads/sports/       → 755
```

### Problem: Dropdown menu not working
**Solution**:
- Clear browser cache (Ctrl+F5)
- Check if new `header.php` was uploaded
- Verify JavaScript is enabled in browser

### Problem: Sample data not showing
**Solution**:
```sql
-- Check if data exists
SELECT * FROM sports;
SELECT * FROM bus_routes;
SELECT * FROM fee_structure;

-- If empty, re-run the INSERT statements from database_additions.sql
```

---

## Cache Clearing

After deployment, clear all caches:

### 1. Hostinger Cache
- hPanel → Advanced → Clear Cache
- Select your domain
- Click Clear Cache

### 2. Browser Cache
- Chrome: Ctrl+Shift+Delete
- Or hard refresh: Ctrl+F5

### 3. PHP OpCache (if enabled)
You can clear it from your admin panel or by creating a file:

```php
<?php
// clear-cache.php (delete after use)
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OpCache cleared!";
} else {
    echo "OpCache not enabled";
}
?>
```

---

## Database Backup (Important!)

**Before running database_additions.sql, backup your database:**

### Via phpMyAdmin:
1. Select your database
2. Click **Export** tab
3. Choose **Quick** export method
4. Click **Go**
5. Save the `.sql` file

### Via hPanel:
- Go to Databases → phpMyAdmin
- Use Export feature
- Keep backup file safe

---

## Admin Panel (Next Steps)

After deploying frontend pages, you'll need to create admin pages to manage content:

Create these files in `admin/` folder:
- `admin/disclosure.php` - Manage disclosure documents
- `admin/sports.php` - Manage sports
- `admin/slc.php` - Manage school leaving certificates
- `admin/bus-routes.php` - Manage bus routes
- `admin/fee-structure.php` - Manage fee structure

---

## File Permissions Guide

| Path | Permission | Description |
|------|------------|-------------|
| `disclosure.php` | 644 | Read-only for web |
| `sports.php` | 644 | Read-only for web |
| `slc.php` | 644 | Read-only for web |
| `bus-routes.php` | 644 | Read-only for web |
| `fee-structure.php` | 644 | Read-only for web |
| `uploads/disclosure/` | 755 | Write access for uploads |
| `uploads/sports/` | 755 | Write access for uploads |

---

## Quick Upload Script

If you have SSH access, create this script:

```bash
#!/bin/bash
# deploy-new-pages.sh

echo "Deploying new pages..."

# Upload PHP files
scp disclosure.php sports.php slc.php bus-routes.php fee-structure.php user@host:/public_html/

# Upload updated header
scp includes/header.php user@host:/public_html/includes/

# Create directories
ssh user@host "mkdir -p /public_html/uploads/disclosure /public_html/uploads/sports"
ssh user@host "chmod 755 /public_html/uploads/disclosure /public_html/uploads/sports"

echo "Files uploaded! Now run database migration in phpMyAdmin."
```

---

## Support

If you encounter issues:

### Hostinger Support
- Live Chat: 24/7 available in hPanel
- Tickets: Submit through hPanel
- Knowledge Base: https://support.hostinger.com

### Things to Check
1. PHP version (should be 7.4+)
2. MySQL version (should be 5.7+)
3. File permissions
4. Error logs (hPanel → Error Logs)

---

## Success Checklist

Everything is working if:
- ✅ Navigation dropdown shows all 5 new pages
- ✅ Each page loads with proper styling
- ✅ Sample data displays on all pages
- ✅ Mobile menu includes new pages
- ✅ No PHP errors
- ✅ No JavaScript console errors
- ✅ Pages are responsive on mobile

---

**Last Updated**: January 4, 2026  
**Version**: 1.0  
**Deployment Time**: ~15-20 minutes
