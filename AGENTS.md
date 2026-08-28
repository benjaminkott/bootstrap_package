# AGENTS.md

## Rules

* No persistent agent memory for this project. Source of truth: this
  file, the checkout, the git history. Durable knowledge → PR against
  this file.
* **Never** write package or version facts into this file — no TYPO3/PHP
  versions, no branch versions, no matrix. They are read from the branch
  you are on: `composer.json`, `.github/workflows/ci.yml`,
  `Build/.nvmrc`, `.ddev/config.yaml`. A change has to hold on every
  TYPO3 major that branch declares, not just the installed one.
* Don't guess TYPO3 APIs, TCA keys, icons, labels — read
  `.build/vendor/typo3/`.
* Only report checks you actually ran.
* Everything that only serves development is `export-ignore`d in
  `.gitattributes` — this file included; it never ships in the package
  artifact.

## Style

* Short, tight, precise — in code, comments, commit messages, PRs and
  docs alike
* Comments say why, never what the code already says; no captain
  obvious, no restated signatures, no block comment where a good name
  does the job
* No over-explained code and no ceremony; a stale comment gets deleted,
  not updated
* Describe what is, never what was — no history, no "previously", no
  "changed from", no former behaviour in code, comments or docs
* Match the surrounding code: naming, structure, comment density
* Wrap Markdown and reST at 72 characters

## Commands

* `ddev start` · `ddev launch typo3` · `ddev composer …` (provides the
  DB for functional tests)
* `composer test` — lint + unit + functional; functional needs the DB →
  `ddev composer test:php:functional`
* `composer cgl:ci` (check) · `composer cgl` (rewrites)
* `composer phpstan` — `Build/phpstan.neon`
* `composer changelog` · `composer set-version`
* `npm --prefix Build ci && npm --prefix Build run build` — full asset
  build
* PHPStan baselines are split per TYPO3 major
  (`Build/phpstan-baseline-*.neon`); `composer phpstan:baseline` writes
  elsewhere — move the entries, prefer fixing

## Tests

* `Tests/Unit` and `Tests/Functional`; functional tests boot the fixture
  package `Tests/Packages/demo_package`
* A bugfix you write comes with a test that fails without it — that is
  the proof. Skip it only when it cannot be tested, and say so in the PR
* For human contributors the same test is a wish, not a requirement —
  never reject a pull request over it

## Frontend build

* Sources: `Build/`, `Resources/Public/Scss/`
* Build output is committed:
  `Resources/Public/Css|JavaScript|Fonts|Icons`
* SCSS/JS/icon change → rebuild, commit generated files in the same
  commit; CI job `build-frontend` fails on a dirty tree
* Node lives in `Build/.nvmrc` and `Build/package.json`; keep
  `nodejs_version` in `.ddev/config.yaml` and the CI setup on it

## Branches

* Work always happens on a topic branch, ideally in its own git
  worktree — never directly in the shared checkout, and never on
  `master` or a release branch
* Topic branches are named after what they do, prefixed by type:
  `task/…`, `bugfix/…`, `feature/…` — e.g.
  `bugfix/indexed-search-pagination`
* Every change goes to `master` first, always as a pull request, never
  as a direct push
* A pull request is rebased onto `master`, never merged into — rebase
  again whenever `master` moved under it
* Once it is merged, backport it: cherry-pick onto the release branches
  it affects, one pull request per branch — check whether it applies
  there, declared versions and tooling differ per branch
* Release branches are named `BP_<major>_<minor>`

## Commits and PRs

* PRs are always squash-merged into `[TYPE] Subject (#<PR number>)`,
  e.g. `[TASK] Drop empty ext_tables.php files (#1641)`
* Types: `[BUGFIX]`, `[TASK]`, `[FEATURE]`; no issue number in the
  subject
* Don't squash a PR branch yourself — the merge does it, original
  commits keep attribution
* Every commit carries a `Signed-off-by:` trailer with the contributor's
  name and mail from `git config` — commit with `git commit -s`

## Agent attribution

* Agent involvement belongs in the PR's *AI assistance* section, and
  nowhere else. Fill it in fully and honestly: agent and version, model
  and effort level, share written by the agent, human review
* Never expose agent sessions: no session links, no tool footers, no
  "generated with …" lines in commit messages, PR titles or PR bodies
* Never add an agent as author or `Co-Authored-By` — commits and pull
  requests carry the human contributor only

## Worktrees

* Never move a branch ref (`git branch -f master <commit>`) — the
  checkout holding that branch stays behind and shows the whole delta as
  staged changes
* Commit in the worktree, push a topic branch, open a PR; check
  `git worktree list` before touching any ref

## Documentation

* User-facing changes → `Documentation/` (reST); `CHANGELOG.md` is
  generated
* Human contribution notes: `Documentation/Contribution/Index.rst` —
  keep in sync with this file
