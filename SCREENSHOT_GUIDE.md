# Quick Reference: Screenshot Placement Guide

## 📁 Folder Structure

```
ChitChat/
├── screenshots/           ← CREATE THIS FOLDER (✅ Already created!)
│   ├── homepage.png      ← Screenshot 1: Main feed
│   ├── dark-mode.png     ← Screenshot 2: Dark theme
│   ├── profile.png       ← Screenshot 3: User profile
│   ├── registration.png  ← Screenshot 4: Sign-up page
│   ├── interactions.png  ← Screenshot 5: Tweet with like/edit
│   ├── about-me.png      ← Screenshot 6: About Me edit
│   └── README.md         ← Instructions (already created)
├── README.md             ← Main documentation (references screenshots)
└── ... (other files)
```

## 🎯 Screenshot Checklist

### Screenshot 1: `homepage.png`
**URL:** `http://localhost:8000` (when logged in)
**Capture:**
```
┌──────────────────────────────────────────┐
│ [ChitChat Logo]    [Profile Dropdown]    │ ← Navigation
├──────────────────────────────────────────┤
│ Sidebar │  Main Feed      │ Trending     │
│         │                 │              │
│ Home    │ What's         │ Who to       │
│ Profile │ happening?     │ Follow       │
│         │ [Post button]  │              │
│         │                │              │
│         │ Tweet 1        │              │
│         │ Tweet 2        │              │
│         │ Tweet 3        │              │
└──────────────────────────────────────────┘
```
**Filename:** `screenshots/homepage.png`

---

### Screenshot 2: `dark-mode.png`
**URL:** Same as homepage, but toggle dark mode first
**Steps:**
1. Click profile picture → toggle dark mode switch
2. Take screenshot of the same homepage view
**Capture:** Same layout as homepage but with dark background
**Filename:** `screenshots/dark-mode.png`

---

### Screenshot 3: `profile.png`
**URL:** `http://localhost:8000/profile/{your-username}`
**Capture:**
```
┌──────────────────────────────────────────┐
│ [Avatar] Your Name                       │
│                                          │
│ Total Tweets: 5    Total Likes: 12      │ ← Stats
│                                          │
│ About Me                                 │
│ [Your bio text here...]                  │
│ [Edit About Me button]                   │
│                                          │
│ ──────────────────────────────────────   │
│ Your Tweet 1                             │
│ Your Tweet 2                             │
└──────────────────────────────────────────┘
```
**Filename:** `screenshots/profile.png`

---

### Screenshot 4: `registration.png`
**URL:** `http://localhost:8000/register` (when logged out)
**Capture:**
```
┌──────────────────────────────────────────┐
│          Create Your Account             │
│                                          │
│ Name: [____________]                     │
│ Email: [___________]                     │
│ Password: [_________]                    │
│                                          │
│ Choose Profile Picture:                  │
│ 😀 😎 🤓 😊 🥳   ← Grid of 20 emojis    │
│ 🤗 😇 🤠 🥰 😜                           │
│ 🤪 😂 🥺 😴 🤔                           │
│ 🧐 😱 🤯 🥴 😈                           │
│                                          │
│ [Create Account button]                  │
└──────────────────────────────────────────┘
```
**Filename:** `screenshots/registration.png`

---

### Screenshot 5: `interactions.png`
**URL:** Homepage, focus on ONE tweet card
**Capture:**
```
┌──────────────────────────────────────────┐
│ [Avatar] Username    · 2h ago   [⋮ menu]│ ← Header
│                                          │
│ This is my tweet content about           │ ← Content
│ something interesting...                 │
│                                          │
│ ♡ 5                                      │ ← Like button
│                                          │
│ (If menu clicked:)                       │
│    ┌──────────┐                          │
│    │ ✏️ Edit  │                          │
│    │ 🗑️ Delete│                          │
│    └──────────┘                          │
└──────────────────────────────────────────┘
```
**Steps:** Click the three-dot menu on your own tweet to show Edit/Delete
**Filename:** `screenshots/interactions.png`

---

### Screenshot 6: `about-me.png`
**URL:** Your profile page with About Me edit form open
**Steps:**
1. Go to your profile
2. Click "Edit About Me" button
**Capture:**
```
┌──────────────────────────────────────────┐
│ [Avatar] Your Name                       │
│                                          │
│ About Me                                 │
│ ┌────────────────────────────────────┐   │
│ │ Tell us about yourself...          │   │ ← Text area
│ │                                    │   │
│ │                                    │   │
│ └────────────────────────────────────┘   │
│ 45 / 500                                 │ ← Character counter
│ [Save] [Cancel]                          │ ← Buttons
└──────────────────────────────────────────┘
```
**Filename:** `screenshots/about-me.png`

---

## 🖼️ How to Take Screenshots (Windows)

### Method 1: Snipping Tool (RECOMMENDED)
1. Press `Windows + Shift + S`
2. Click and drag to select area
3. Screenshot is copied to clipboard
4. Press `Ctrl + V` in Paint or directly save from notification
5. Save to `screenshots/` folder with correct filename

### Method 2: Full Screen
1. Press `PrtScn` (Print Screen key)
2. Open Paint
3. Press `Ctrl + V`
4. Crop as needed
5. Save to `screenshots/` folder

### Method 3: Windows Snip & Sketch
1. Press `Windows + Shift + S`
2. Click notification that appears
3. Use "Save As" and navigate to screenshots folder
4. Use exact filename from list above

## ✅ After Taking All Screenshots

1. Verify all 6 files exist in `screenshots/` folder
2. Check filenames match exactly (lowercase, .png extension)
3. Open each image to verify it's clear and readable
4. The README.md will automatically show them

## 📌 Important Notes

- **Use EXACT filenames** - Case-sensitive, must be lowercase
- **PNG format only** - Not JPG or JPEG
- **Minimum size:** 1280x720 recommended
- **Clean browser:** Hide bookmarks, unnecessary tabs
- **Realistic data:** Create a few test tweets for better visuals

---

Ready to capture your work! 📸
