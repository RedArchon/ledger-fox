# Changelog

All notable changes to `ledger-fox` will be documented in this file.

## Unreleased

### Changed
- Rebuilt on the official [Laravel package skeleton](https://github.com/laravel/package-skeleton) (`config` + `commands` features)
- Publish tags now follow skeleton dual-tag convention: `ledger-fox` plus `ledger-fox-config` / `ledger-fox-rules` / `ledger-fox-agents`
- Service provider registers `AboutCommand` metadata per Laravel package docs
- Commands live under `src/Console/Commands`

### Added
- Testbench workbench, Pint, Larastan, GitHub Actions, Dependabot, security policy

## 0.1.0 - 2026-11-03

- Initial public scaffold with Cursor rule/agent publish stubs
