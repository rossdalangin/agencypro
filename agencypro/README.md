# AgencyPro WordPress Theme

AgencyPro is a modern, vibrant, and highly customizable WordPress theme designed specifically for digital agencies, marketing firms, and creative studios. It features a dark, bold design, extensive customization options, and a focus on showcasing your work and generating leads.

**Version:** 2.2.0
**Author:** Jules

---

## Features

*   **Fully Modular Homepage:** Show, hide, and reorder all homepage sections using a simple "Order" field in each section.
*   **Dynamic Section Backgrounds:** Set a unique background for each homepage section: None, Color, Image, or a two-color Gradient.
*   **Header & Footer Customization:** Control the background and link/text colors for the site's header and footer.
*   **Advanced Typography Controls:** Manage your site's primary accent color, body/heading text colors, and choose from a curated list of Google Fonts for your headings.
*   **Custom Post Types:** Easy-to-manage sections for your Portfolio (`Projects`), `Services`, and `Testimonials`.
*   **AJAX-Powered Portfolio:** A beautiful portfolio page with a masonry layout, tab-style filtering, and a "Load More" button.
*   **Modern, Responsive Design:** Built with HTML5, CSS3, and modern JavaScript for a great experience on all devices.

---

## Theme Setup and Installation

1.  **Package the Theme:** Compress the `agencypro` folder into a `.zip` file.
2.  **Install the Theme:** In your WordPress dashboard, go to `Appearance > Themes > Add New > Upload Theme`, choose your `agencypro.zip` file, and click `Install Now`, then `Activate`.

---

## Configuring the Theme

All theme options are controlled via the WordPress Customizer (`Appearance > Customize`).

### 1. Create & Set Required Pages

1.  **Create Pages:** Go to `Pages > Add New` and create three pages:
    *   One named "Home" (assign the **Homepage** template).
    *   One named "Portfolio" (assign the **Portfolio** template).
    *   One named "Blog".
2.  **Set Static Pages:** Go to `Settings > Reading`, set "Your homepage displays" to **A static page**, and assign your "Home" and "Blog" pages accordingly.

### 2. Add Your Content (CPTs)

*   **Services (`Dashboard > Services`):** Add your company's services. Set a **Featured Image** and write a full description for the single service page.
*   **Portfolio (`Dashboard > Portfolio`):** Add your case studies. Set a **Featured Image** and assign a **Service Type**.
*   **Testimonials (`Dashboard > Testimonials`):** Add client testimonials. The post title is the author's name, and the **Featured Image** is their picture.

### 3. Customize the Homepage (`Appearance > Customize > Homepage Sections`)

This panel gives you full control over the homepage layout.

*   **For Each Section (Hero, Clients, etc.):**
    *   **Order:** Enter a number to set the display order (e.g., 10, 20, 30). Lower numbers appear first.
    *   **Display Section:** Use the checkbox to show or hide the entire section.
    *   **Background Type:** Choose between `None` (fully transparent), `Color`, `Image`, or `Gradient`.
    *   **Client Logos:** Use the 8 available slots to upload each of your client logos individually.
    *   **Content Fields:** Fill in the headlines, text, and button information for each section.

### 4. Header & Footer (`Appearance > Customize > Header & Footer`)

*   In this panel, you can set the background colors and text/link colors for the site-wide header and footer.

### 5. Typography & Colors (`Appearance > Customize > Typography & Colors`)

*   **Font Colors:** Set the global colors for the body text and headings.
*   **Heading Font Family:** Choose a font for all headings (H1-H6) from the dropdown list. The theme will automatically load the chosen font from Google Fonts.
*   Go to **Theme Options > Global Colors** to set the main accent color.

---

## Final Packaging Instructions

**Using a command line (macOS/Linux):**
1.  Navigate to the directory that *contains* the `agencypro` folder.
2.  Run: `zip -r agencypro.zip agencypro/`

**Using a graphical interface (Windows/macOS):**
1.  Right-click on the `agencypro` folder.
2.  Select "Compress" (macOS) or "Send to > Compressed (zipped) folder" (Windows).
3.  Rename the file to `agencypro.zip`.
