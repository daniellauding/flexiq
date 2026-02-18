# FlexIQ Backend Optimization - Quick Start Guide

**Purpose:** Implement priority optimizations for production readiness  
**Time Required:** 2-3 hours  
**Impact:** 50-70% performance improvement

---

## Quick Implementation Steps

### Step 1: Pattern Caching (30 minutes)

**Replace** the current `flexiq_load_patterns()` function in `functions.php`:

```php
/**
 * Load block patterns with caching
 */
function flexiq_load_patterns() {
    // Check transient cache
    $cached_patterns = get_transient( 'flexiq_patterns_cache' );
    
    if ( false !== $cached_patterns && is_array( $cached_patterns ) ) {
        foreach ( $cached_patterns as $pattern ) {
            register_block_pattern( $pattern['slug'], $pattern['args'] );
        }
        return;
    }
    
    try {
        $patterns_dir = get_template_directory() . '/patterns/';
        
        if ( ! is_dir( $patterns_dir ) ) {
            error_log( '[FlexIQ] Patterns directory not found: ' . $patterns_dir );
            return;
        }
        
        $pattern_files = glob( $patterns_dir . '*.php' );
        
        if ( empty( $pattern_files ) ) {
            error_log( '[FlexIQ] No pattern files found' );
            return;
        }
        
        $patterns_to_cache = array();
        
        foreach ( $pattern_files as $file ) {
            if ( ! file_exists( $file ) || ! is_readable( $file ) ) {
                error_log( '[FlexIQ] Pattern file not accessible: ' . basename( $file ) );
                continue;
            }
            
            $file_data = get_file_data(
                $file,
                array(
                    'title'       => 'Title',
                    'slug'        => 'Slug',
                    'description' => 'Description',
                    'categories'  => 'Categories',
                )
            );
            
            if ( empty( $file_data['slug'] ) ) {
                continue;
            }
            
            ob_start();
            include $file;
            $content = ob_get_clean();
            
            $content = preg_replace( '/^<\?php.*?\?>\s*/s', '', $content );
            $categories = array_map( 'trim', explode( ',', $file_data['categories'] ) );
            
            $pattern_args = array(
                'title'       => $file_data['title'],
                'description' => $file_data['description'],
                'categories'  => $categories,
                'content'     => trim( $content ),
            );
            
            register_block_pattern( $file_data['slug'], $pattern_args );
            
            $patterns_to_cache[] = array(
                'slug' => $file_data['slug'],
                'args' => $pattern_args,
            );
        }
        
        // Cache for 1 hour
        set_transient( 'flexiq_patterns_cache', $patterns_to_cache, HOUR_IN_SECONDS );
        
    } catch ( Exception $e ) {
        error_log( '[FlexIQ] Pattern loading failed: ' . $e->getMessage() );
    }
}

/**
 * Clear pattern cache on theme switch
 */
function flexiq_clear_pattern_cache() {
    delete_transient( 'flexiq_patterns_cache' );
}
add_action( 'after_switch_theme', 'flexiq_clear_pattern_cache' );
```

**Expected Result:** 50-70% reduction in theme initialization time

---

### Step 2: Production wp-config.php (15 minutes)

**Add to** `wordpress/wp-config.php` (before `require_once ABSPATH . 'wp-settings.php';`):

```php
/**
 * FlexIQ Production Configuration
 */

// Error Logging (Production)
define( 'WP_DEBUG', false );              // Disable debug mode
define( 'WP_DEBUG_LOG', true );           // Enable error logging
define( 'WP_DEBUG_DISPLAY', false );      // Don't display errors
@ini_set( 'display_errors', 0 );

// Memory Limits
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );

// Performance
define( 'AUTOSAVE_INTERVAL', 300 );       // 5 minutes (reduce DB writes)
define( 'WP_POST_REVISIONS', 5 );         // Limit revisions to 5
define( 'EMPTY_TRASH_DAYS', 30 );         // Auto-empty trash after 30 days

// Security
define( 'DISALLOW_FILE_EDIT', true );     // Disable theme/plugin editor
define( 'FORCE_SSL_ADMIN', true );        // Force SSL for admin (when ready)

// Caching
define( 'WP_CACHE', true );               // Enable object caching (when Redis installed)
```

**Expected Result:** Better error handling, improved security, foundation for caching

---

### Step 3: Error Logging Helper (10 minutes)

**Add to** `functions.php` (at the top, after ABSPATH check):

```php
/**
 * Error logging helper function
 */
function flexiq_log_error( $message, $context = array() ) {
    if ( WP_DEBUG_LOG ) {
        $log_message = sprintf(
            '[FlexIQ] %s',
            $message
        );
        
        if ( ! empty( $context ) ) {
            $log_message .= ' | Context: ' . json_encode( $context );
        }
        
        error_log( $log_message );
    }
}

/**
 * Log slow queries in development
 */
function flexiq_log_slow_queries() {
    if ( ! WP_DEBUG ) {
        return;
    }
    
    global $wpdb;
    
    if ( isset( $wpdb->queries ) && count( $wpdb->queries ) > 20 ) {
        flexiq_log_error( 'High query count detected', array(
            'total_queries' => count( $wpdb->queries ),
            'page' => $_SERVER['REQUEST_URI'] ?? 'unknown',
        ) );
    }
}
add_action( 'shutdown', 'flexiq_log_slow_queries' );
```

**Expected Result:** Better debugging, production error tracking

---

### Step 4: Monitor Logs (5 minutes)

**Check error logs:**

```bash
cd ~/Work/external/flexiq
tail -f wordpress/wp-content/debug.log
```

**Test pattern caching:**

1. Visit the site (patterns will be cached)
2. Check logs for any errors
3. Refresh page (patterns should load from cache)
4. Visit `/wp-admin/themes.php` to verify patterns visible

---

### Step 5: Database Query Monitoring (30 minutes)

**Install Query Monitor plugin:**

```bash
cd ~/Work/external/flexiq/wordpress/wp-content/plugins
wget https://downloads.wordpress.org/plugin/query-monitor.latest.zip
unzip query-monitor.latest.zip
rm query-monitor.latest.zip
```

**Activate in WordPress Admin:**
1. Visit `/wp-admin/plugins.php`
2. Activate "Query Monitor"
3. Visit homepage and check query count
4. Target: <15 queries per page

---

## Verification Checklist

### ✅ Pattern Caching Working

- [ ] No errors in debug.log
- [ ] First page load: patterns registered
- [ ] Second page load: patterns loaded from cache
- [ ] Transient visible in `wp_options` table (`flexiq_patterns_cache`)

**Test:**
```sql
SELECT option_name, option_value 
FROM wp_options 
WHERE option_name LIKE '%flexiq_patterns%';
```

### ✅ Error Logging Working

- [ ] `wp-content/debug.log` exists
- [ ] Logs show timestamp and context
- [ ] No errors during normal operation
- [ ] Slow query warnings logged (if applicable)

### ✅ Production Config Applied

- [ ] WP_DEBUG = false
- [ ] WP_DEBUG_LOG = true
- [ ] WP_DEBUG_DISPLAY = false
- [ ] Post revisions limited
- [ ] Memory limits increased

---

## Performance Before/After

### Measure Performance

**Before optimization:**
```bash
# Install Query Monitor, visit homepage, check:
- Total queries: ~15-20
- Query time: ~50-100ms
- PHP time: ~100-200ms
```

**After optimization:**
```bash
# With caching enabled:
- Total queries: ~10-15
- Query time: ~30-50ms (improved)
- PHP time: ~50-100ms (improved)
```

**Expected improvements:**
- 30-50% reduction in PHP execution time
- 20-30% reduction in query time
- Patterns load instantly from cache

---

## Next Steps (Optional)

### Redis Object Cache (Advanced - 2 hours)

If Redis is available:

1. **Install Redis:**
   ```bash
   brew install redis  # macOS
   # or
   sudo apt install redis-server  # Linux
   ```

2. **Start Redis:**
   ```bash
   redis-server
   ```

3. **Install object-cache.php:**
   ```bash
   cd ~/Work/external/flexiq/wordpress/wp-content
   wget https://raw.githubusercontent.com/rhubarbgroup/redis-cache/master/includes/object-cache.php
   ```

4. **Update wp-config.php:**
   ```php
   define( 'WP_CACHE', true );
   define( 'WP_CACHE_KEY_SALT', 'flexiq_' );
   define( 'WP_REDIS_HOST', '127.0.0.1' );
   define( 'WP_REDIS_PORT', 6379 );
   ```

5. **Test:**
   - Visit homepage
   - Check Redis: `redis-cli KEYS "flexiq_*"`
   - Expected: 50-80% query reduction

---

## Troubleshooting

### Patterns not loading

**Check:**
1. `wp_options` table for `flexiq_patterns_cache` transient
2. Error log for pattern loading errors
3. File permissions on `/patterns/` directory

**Clear cache:**
```sql
DELETE FROM wp_options WHERE option_name LIKE '%flexiq_patterns%';
```

### High query count

**Debug:**
1. Install Query Monitor
2. Identify slow queries
3. Add caching for expensive queries

### Error log not writing

**Check:**
1. `wp-content/` directory is writable
2. `WP_DEBUG_LOG` is true
3. PHP `error_log` directive configured

---

## Success Metrics

### ✅ Optimization Complete When:

- [ ] Pattern caching implemented and working
- [ ] Error logging functional
- [ ] Production wp-config.php configured
- [ ] Query Monitor shows <15 queries per page
- [ ] No errors in debug.log during normal operation
- [ ] Page load time <500ms (local)

### 🚀 Ready for Production When:

- [ ] All above ✅ complete
- [ ] Redis object cache installed (optional but recommended)
- [ ] Query count <10 per page
- [ ] Page load time <200ms
- [ ] Load tested with traffic

---

## Support

**Documentation:** `BACKEND-ARCHITECTURE-AUDIT.md`  
**Full Details:** See main audit document for complete architecture analysis

---

**Quick Start Version:** 1.0  
**Last Updated:** 2026-02-11  
**Estimated Time:** 2-3 hours  
**Impact:** High (50-70% performance improvement)
