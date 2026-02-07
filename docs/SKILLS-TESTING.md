# Testing Skills

## 🧪 WordPress Testing

### PHP Unit Testing
```bash
# Install WP test suite
composer require --dev phpunit/phpunit wp-phpunit/wp-phpunit
```

```php
// tests/test-theme-functions.php
class ThemeFunctionsTest extends WP_UnitTestCase {
    public function test_theme_supports_registered() {
        $this->assertTrue(current_theme_supports('align-wide'));
        $this->assertTrue(current_theme_supports('responsive-embeds'));
    }
    
    public function test_custom_post_types_exist() {
        $this->assertTrue(post_type_exists('job_listing'));
    }
}
```

### WP-CLI Testing
```bash
# Validate theme
wp theme activate flexiq
wp doctor check --all

# Test REST API
wp rest get /wp/v2/posts
```

---

## 🎭 E2E Testing (Playwright)

### Setup
```bash
npm install -D @playwright/test
npx playwright install
```

### playwright.config.js
```js
export default {
  testDir: './tests/e2e',
  use: {
    baseURL: 'http://localhost:8080',
    screenshot: 'only-on-failure',
  },
  projects: [
    { name: 'Desktop Chrome', use: { ...devices['Desktop Chrome'] } },
    { name: 'Mobile Safari', use: { ...devices['iPhone 13'] } },
  ],
};
```

### Example Tests
```js
// tests/e2e/navigation.spec.js
import { test, expect } from '@playwright/test';

test('homepage loads correctly', async ({ page }) => {
  await page.goto('/');
  await expect(page).toHaveTitle(/FlexIQ/);
  await expect(page.locator('h1')).toBeVisible();
});

test('navigation works', async ({ page }) => {
  await page.goto('/');
  await page.click('text=Om FlexIQ');
  await expect(page).toHaveURL(/om-flexiq/);
});

test('contact form submits', async ({ page }) => {
  await page.goto('/kontakt');
  await page.fill('[name="name"]', 'Test User');
  await page.fill('[name="email"]', 'test@example.com');
  await page.fill('[name="message"]', 'Test message');
  await page.click('button[type="submit"]');
  await expect(page.locator('.success-message')).toBeVisible();
});
```

---

## ♿ Accessibility Testing

### Automated (axe-core)
```js
// tests/e2e/accessibility.spec.js
import { test, expect } from '@playwright/test';
import AxeBuilder from '@axe-core/playwright';

test('homepage has no accessibility violations', async ({ page }) => {
  await page.goto('/');
  const results = await new AxeBuilder({ page }).analyze();
  expect(results.violations).toEqual([]);
});

test('forms are accessible', async ({ page }) => {
  await page.goto('/kontakt');
  const results = await new AxeBuilder({ page })
    .include('form')
    .analyze();
  expect(results.violations).toEqual([]);
});
```

### Manual Checklist
- [ ] Tab through entire page
- [ ] Screen reader test (VoiceOver/NVDA)
- [ ] Zoom to 200%
- [ ] High contrast mode
- [ ] Keyboard-only navigation

---

## 📱 Responsive Testing

```js
// tests/e2e/responsive.spec.js
const viewports = [
  { name: 'mobile', width: 375, height: 667 },
  { name: 'tablet', width: 768, height: 1024 },
  { name: 'desktop', width: 1440, height: 900 },
];

for (const viewport of viewports) {
  test(`homepage renders on ${viewport.name}`, async ({ page }) => {
    await page.setViewportSize(viewport);
    await page.goto('/');
    await expect(page.locator('header')).toBeVisible();
    await expect(page.locator('footer')).toBeVisible();
    // Screenshot for visual review
    await page.screenshot({ 
      path: `screenshots/home-${viewport.name}.png` 
    });
  });
}
```

---

## 🔍 Visual Regression Testing

```js
// tests/e2e/visual.spec.js
import { test, expect } from '@playwright/test';

test('homepage visual regression', async ({ page }) => {
  await page.goto('/');
  await expect(page).toHaveScreenshot('homepage.png', {
    maxDiffPixels: 100,
  });
});

test('components visual regression', async ({ page }) => {
  await page.goto('/styles');
  
  // Test each component
  await expect(page.locator('.hero')).toHaveScreenshot('hero.png');
  await expect(page.locator('.services')).toHaveScreenshot('services.png');
});
```

---

## ⚡ Performance Testing

### Lighthouse CI
```js
// lighthouserc.js
module.exports = {
  ci: {
    collect: {
      url: ['http://localhost:8080/', 'http://localhost:8080/kontakt'],
      numberOfRuns: 3,
    },
    assert: {
      assertions: {
        'categories:performance': ['error', { minScore: 0.9 }],
        'categories:accessibility': ['error', { minScore: 0.95 }],
        'categories:seo': ['error', { minScore: 0.9 }],
        'first-contentful-paint': ['warn', { maxNumericValue: 2000 }],
        'largest-contentful-paint': ['error', { maxNumericValue: 2500 }],
      },
    },
  },
};
```

### Core Web Vitals Test
```js
test('meets Core Web Vitals', async ({ page }) => {
  await page.goto('/');
  
  const metrics = await page.evaluate(() => {
    return new Promise((resolve) => {
      new PerformanceObserver((list) => {
        const entries = list.getEntries();
        resolve({
          lcp: entries.find(e => e.entryType === 'largest-contentful-paint')?.startTime,
          cls: entries.find(e => e.entryType === 'layout-shift')?.value,
        });
      }).observe({ entryTypes: ['largest-contentful-paint', 'layout-shift'] });
    });
  });
  
  expect(metrics.lcp).toBeLessThan(2500);
  expect(metrics.cls).toBeLessThan(0.1);
});
```

---

## 📋 Test Scripts (package.json)

```json
{
  "scripts": {
    "test": "npm run test:unit && npm run test:e2e",
    "test:unit": "phpunit",
    "test:e2e": "playwright test",
    "test:a11y": "playwright test tests/e2e/accessibility.spec.js",
    "test:visual": "playwright test tests/e2e/visual.spec.js --update-snapshots",
    "test:perf": "lhci autorun",
    "test:watch": "playwright test --ui"
  }
}
```

---

## ✅ CI/CD Pipeline (GitHub Actions)

```yaml
# .github/workflows/test.yml
name: Test
on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: actions/setup-node@v4
      - run: npm ci
      - run: npx playwright install --with-deps
      - run: docker-compose up -d
      - run: npm run test:e2e
      - run: npm run test:a11y
      - uses: actions/upload-artifact@v4
        if: failure()
        with:
          name: test-results
          path: test-results/
```
