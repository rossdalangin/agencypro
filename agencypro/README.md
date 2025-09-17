# AgencyPro WordPress Theme

AgencyPro is a modern, vibrant, and highly customizable WordPress theme designed specifically for digital agencies, marketing firms, and creative studios. It features a dark, bold design, extensive customization options, and a focus on showcasing your work and generating leads.

**Version:** 2.0.0
**Author:** Jules

---

## Features

*   **Fully Modular Homepage:** Show, hide, and reorder all homepage sections directly from the Customizer.
*   **Dynamic Section Backgrounds:** Set a unique background for each homepage section: None, Color, Image, or a two-color Gradient.
*   **Custom Post Types:** Easy-to-manage sections for your Portfolio (`Projects`), `Services`, and `Testimonials`.
*   **AJAX-Powered Portfolio:** A beautiful portfolio page with smooth, category-based filtering.
*   **Blog with Masonry Layout:** A modern blog layout that showcases your posts in a stylish masonry grid.
*   **Sidebar Widget Area:** A dedicated sidebar for your single blog posts.
*   **Advanced Color & Typography Controls:** Manage your site's primary accent color, body text color, and heading colors.
*   **Modern, Responsive Design:** Built with HTML5, CSS3, and modern JavaScript for a great experience on all devices.

---

## Theme Setup and Installation

1.  **Package the Theme:**
    *   Navigate to the root directory containing the `agencypro` theme folder.
    *   Compress the `agencypro` folder into a `.zip` file. The final file should be named `agencypro.zip`.

2.  **Install the Theme:**
    *   In your WordPress dashboard, navigate to `Appearance` > `Themes`.
    *   Click `Add New`, then `Upload Theme`.
    *   Choose the `agencypro.zip` file and click `Install Now`.
    *   Click `Activate`.

---

## Configuring the Theme

All theme options are controlled via the WordPress Customizer. Navigate to `Appearance` > `Customize` to begin.

### 1. Create Required Pages

1.  **Homepage:**
    *   Go to `Pages` > `Add New`. Title it "Home".
    *   Under "Page Attributes", select the **Homepage** template.
    *   `Publish`.
2.  **Portfolio Page:**
    *   Go to `Pages` > `Add New`. Title it "Portfolio".
    *   Under "Page Attributes", select the **Portfolio** template.
    *   `Publish`.
3.  **Blog Page:**
    *   Go to `Pages` > `Add New`. Title it "Blog" or "News". You do not need to select a template.
    *   `Publish`.
4.  **Set Static Pages:**
    *   Go to `Settings` > `Reading`.
    *   Set "Your homepage displays" to **A static page**.
    *   For "Homepage", select the "Home" page you created.
    *   For "Posts page", select the "Blog" page you created.
    *   Save your changes.

### 2. Add Your Content (CPTs)

*   **Services (`Dashboard > Services`):** Add your company's services here. Use the "Custom Fields" box to add an `icon_class` for display.
*   **Portfolio (`Dashboard > Portfolio`):** Add your case studies. Set a **Featured Image** (crucial for display) and assign a **Service Type**.
*   **Testimonials (`Dashboard > Testimonials`):** Add client testimonials. The post title is the author's name, the main content is the testimonial text, and the **Featured Image** is the author's picture.

### 3. Customize the Homepage (`Appearance > Customize > Homepage Sections`)

This panel gives you full control over the homepage content and layout.

*   **Section Order:** This is the most powerful feature. Enter a comma-separated list of section IDs to control their order.
    *   **Available IDs:** `hero`, `clients`, `services`, `portfolio`, `promo`, `testimonials`, `cta`
    *   **Example:** `hero,services,promo,cta`
*   **For Each Section (Hero, Clients, etc.):**
    *   **Display Section:** Use the checkbox at the top to show or hide the entire section.
    *   **Background Type:** Choose between `None`, `Color`, `Image`, or `Gradient`. The relevant controls (e.g., color pickers) will appear below based on your choice.
    *   **Content Fields:** Fill in the headlines, text, and button information for each section. The "Promo" section is a new flexible content block, and the "Call to Action" section now includes a sub-headline field.

### 4. Blog & Sidebar

*   The theme will automatically use a masonry layout for your blog posts on the page you designated in `Settings > Reading`.
*   To add widgets to your single post sidebar, go to `Appearance` > `Widgets` and drag any widget into the **Blog Sidebar** area.

### 5. Typography & Colors (`Appearance > Customize > Typography & Colors`)

*   **Font Colors:** Set the global colors for the body text and all headings (H1-H6).
*   **Theme Options > Colors:** Control the main accent color used for buttons, links, and highlights.

---

## Final Packaging Instructions

To create the installation-ready `.zip` file for this theme:

**Using a command line (macOS/Linux):**
1.  Navigate to the directory that *contains* the `agencypro` folder.
2.  Run: `zip -r agencypro.zip agencypro/`

**Using a graphical interface (Windows/macOS):**
1.  Right-click on the `agencypro` folder.
2.  Select "Compress" (macOS) or "Send to > Compressed (zipped) folder" (Windows).
3.  Rename the file to `agencypro.zip`.
