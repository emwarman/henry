# Leave a Message

A single-file PHP app with a "leave a message" form. Submissions are stored in a flat CSV file — no database required.

## Requirements

- PHP 8+ (install via `brew install php` on macOS)

## Running locally

```
cd /Users/emac/code/henry
php -S localhost:8000
```

Then open `http://localhost:8000` in a browser.

## How it works

- `index.php` — the entire app: form, validation, storage, and display.
- `messages.csv` — created automatically on first submission. Each row is `name,message,date` (CSV-escaped). Delete this file (or empty it) to clear all stored messages.

Submissions require both a name and a message (enforced client-side via a disabled submit button, and server-side as a backstop). Entries are rendered newest-first below the form, with the name in red and the message in black, aligned under the input boxes.
