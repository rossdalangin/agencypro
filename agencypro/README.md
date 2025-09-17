# AgencyPro WordPress Theme

AgencyPro is a modern, vibrant, and conversion-focused WordPress theme designed specifically for digital agencies, marketing firms, and creative studios. It features a dark, bold design, extensive customization options, and a focus on showcasing your work and generating leads.

**Version:** 1.0.0
**Author:** Jules

---

## Features

*   **Modern, Responsive Design:** Dark theme built with HTML5, CSS3, and modern JavaScript.
*   **Conversion-Focused:** Prominent "Get a Quote" calls-to-action to drive lead generation.
*   **Custom Post Types:** Easy-to-manage sections for your Portfolio (`Projects`) and `Services`.
*   **AJAX-Powered Portfolio:** A beautiful portfolio page with smooth, category-based filtering that doesn't require a page reload.
*   **Homepage Built with the Customizer:** A fully widgetized-like homepage controlled entirely through the native WordPress Customizer. No complex page builders required.
*   **Dynamic & Interactive:** Features subtle animations and micro-interactions to provide a cutting-edge feel.

---

## Theme Setup and Installation

1.  **Package the Theme:**
    *   Navigate to the root directory containing the `agencypro` theme folder.
    *   Compress the `agencypro` folder into a `.zip` file. Make sure you are zipping the folder itself, not the files inside it. The final file should be named `agencypro.zip`.

2.  **Install the Theme:**
    *   In your WordPress dashboard, navigate to `Appearance` > `Themes`.
    *   Click `Add New`, then `Upload Theme`.
    *   Choose the `agencypro.zip` file you just created and click `Install Now`.
    *   After the installation is complete, click `Activate`.

---

## Configuring the Theme

Almost all theme options are controlled via the WordPress Customizer. Navigate to `Appearance` > `Customize` to begin.

### 1. Create Required Pages

1.  **Homepage:**
    *   Go to `Pages` > `Add New`.
    *   Give the page a title, like "Home".
    *   In the "Page Attributes" panel on the right, select the **Homepage** template from the "Template" dropdown.
    *   Click `Publish`.
2.  **Portfolio Page:**
    *   Go to `Pages` > `Add New`.
    *   Give the page a title, like "Our Work" or "Portfolio".
    *   In the "Page Attributes" panel, select the **Portfolio** template.
    *   Click `Publish`.
3.  **Set the Homepage:**
    *   Go to `Settings` > `Reading`.
    *   Set "Your homepage displays" to **A static page**.
    *   For "Homepage", select the "Home" page you created.
    *   Save your changes.

### 2. Add Your Content

The theme's dynamic content is managed through Custom Post Types.

*   **Services (`Dashboard > Services`):**
    *   Go to `Services` > `Add New`.
    *   Add a title (e.g., "Web Design") and a description for each service.
    *   **To add an icon:** This theme supports icon fonts. In the post editor, find the "Custom Fields" box (you may need to enable it under "Screen Options" at the top). Add a new custom field with the `name` `icon_class` and the `value` being the CSS class of your icon (e.g., `fas fa-laptop-code`).
*   **Portfolio (`Dashboard > Portfolio`):**
    *   Go to `Portfolio` > `Add New`.
    *   Add a title and a detailed case study description.
    *   Set a **Featured Image** for the project. This is crucial as it's used for the grid and hero images.
    *   Assign the project to one or more **Service Types**. You can create new service types (e.g., "Branding", "SEO") from this screen, which will automatically appear in the portfolio filter.

### 3. Customize the Homepage

Navigate to `Appearance` > `Customize` and open the **Homepage Sections** panel. Here you can control the content of each section on the homepage.

*   **Hero Section:** Set the main headline, sub-headline, and the primary call-to-action button.
*   **Client Logos Section:** Add a headline and upload multiple client logos using the media gallery control.
*   **Services Preview:** Set the headline and choose how many services to display.
*   **Portfolio Preview:** Set the headline and choose how many recent projects to show.
*   **Testimonials:** Fill in the text and author for up to three testimonials.
*   **Call to Action:** Configure the final CTA block at the bottom of the page.

### 4. General Theme Options

In `Appearance` > `Customize`, open the **Theme Options** panel.

*   **Colors:** Change the primary accent color used throughout the theme.
*   **Footer:** Update the copyright text displayed in the site footer.

---

## Final Packaging Instructions

To create the installation-ready `.zip` file for this theme, follow these steps:

**Using a command line (on macOS/Linux):**

1.  Make sure you are in the directory that *contains* the `agencypro` folder.
2.  Run the following command:
    ```bash
    zip -r agencypro.zip agencypro/
    ```

**Using a graphical interface (Windows/macOS):**

1.  Locate the `agencypro` folder.
2.  Right-click on the folder.
3.  Select "Compress 'agencypro'" (on macOS) or "Send to > Compressed (zipped) folder" (on Windows).
4.  Rename the resulting `.zip` file to `agencypro.zip` if it is not already named that.

The resulting `agencypro.zip` is now ready to be uploaded to any WordPress site.
