# Contributing

Thank you for considering a contribution to `atldays/laravel-agent`.

This document describes the expected development workflow, code quality rules, and pull request conventions for the package.

## Support

If you have a bug report, feature request, or improvement idea, please open an issue before starting large changes whenever possible.

## Development Setup

Clone the repository and install dependencies:

```bash
composer install
```

Git hooks are installed automatically through Composer scripts. If you need to install them manually:

```bash
composer hooks:install
```

## Branches

This repository follows a **GitFlow** branching model.

Main branches:

- `main` for production-ready releases
- `develop` for ongoing integration work

Please branch from the correct base depending on the type of change:

- `feature/*` from `develop` for new features and improvements
- `release/*` from `develop` for release preparation
- `hotfix/*` from `main` for urgent production fixes

Examples:

- `feature/browser-detection`
- `feature/add-agent-inspector`
- `release/1.0.0`
- `hotfix/fix-bot-middleware`

If you are unsure which branch to target:

- use `develop` for normal feature work
- use `main` only for hotfix-oriented flows

## Code Style

This package uses [Laravel Pint](https://laravel.com/docs/pint) for formatting.

Before opening a pull request, run:

```bash
composer format
```

To verify formatting without changing files:

```bash
composer format:test
```

## Tests

All changes should be covered by tests whenever it makes sense.

Run the full test suite:

```bash
composer test
```

Run formatting and tests together:

```bash
composer check
```

## Commit Messages

This repository uses **Conventional Commits**.

Please write commit messages in the following format:

```text
type(scope): short description
```

Examples:

- `feat(browser): add edge detection helper`
- `fix(device): handle portable media player type`
- `docs(readme): expand quick start section`
- `test(agent): add fixture-based user agent coverage`

Common commit types:

- `feat`
- `fix`
- `docs`
- `refactor`
- `test`
- `chore`
- `build`
- `ci`

Try to keep commit messages:

- lowercase
- concise
- descriptive
- focused on a single change

## Pull Requests

Please keep pull requests focused and easy to review.

A good pull request should:

- have a clear title
- describe what changed and why
- include tests for behavior changes
- include documentation updates when the public API changes
- keep unrelated refactors out of the same PR

If your change affects package usage, please update:

- `README.md`
- tests
- public API documentation in docblocks when relevant

## Expectations for Contributions

When contributing code, please follow these principles:

- prefer typed, explicit APIs over loose arrays
- keep Laravel integration ergonomic and predictable
- avoid breaking public API without clear reason
- prefer focused changes over broad rewrites
- add or update tests for any meaningful behavioral change

## Reporting Security Issues

If you discover a security issue, please avoid opening a public issue with sensitive details. Contact the maintainer privately first.

## Thank You

Contributions of all sizes are welcome, including bug reports, tests, documentation improvements, and API refinements.
