# Macareux Bulk Page Delete

The Macareux Bulk Page Delete package provides a Concrete CMS console command to delete pages and their child pages in bulk based on a specified page path.

## Installation

1. Download the package ZIP file from the [Releases](https://github.com/macareuxdigital/md_bulk_page_delete/releases) page.
2. Extract the ZIP file contents.
3. Rename the extracted folder to `md_bulk_page_delete` (if necessary).
4. Move the `md_bulk_page_delete` folder to the `packages/` directory of your Concrete CMS installation.
5. Log in to your Concrete CMS site as an administrator.
6. Navigate to the "Extend Concrete CMS" page (Dashboard -> Extend Concrete CMS).
7. Locate the "Macareux Bulk Page Delete" package in the list and click the "Install" button.
8. Follow the on-screen instructions to complete the installation.

## Usage

To use the Bulk Page Delete command, open the terminal and navigate to your Concrete CMS installation directory. Then run the following command:

```bash
./concrete/bin/concrete5 md:page:delete "/path/to/page"
```

Replace `"/path/to/page"` with the actual path of the page you want to delete. The command will delete the specified page and all its child pages.

## Important Note

- **Please use this command with caution.** Bulk page deletion is a powerful operation that permanently removes pages and their content from your Concrete CMS site. Make sure you have a backup of your site before using this command, and double-check the page path to avoid unintended deletions.
- This package and command are provided as-is without any warranty or guarantee. Use it at your own risk.

## Contributing

Contributions to the Macareux Bulk Page Delete package are welcome! If you find any issues or have suggestions for improvements, please feel free to open an issue or submit a pull request on the [GitHub repository](https://github.com/macareuxdigital/md_bulk_page_delete).

## License

The "Macareux Bulk Page Delete" package is open-source software licensed under the [MIT License](LICENSE).
