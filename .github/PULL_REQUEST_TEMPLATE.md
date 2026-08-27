## Description

<!-- What does this change do, and why is it needed? -->

## Type of change

* [ ] Bugfix
* [ ] Task
* [ ] Feature
* [ ] Documentation

## Related issues

<!-- Closes #123, Fixes #456 — leave empty if there is none. -->

## How to validate

<!-- The steps a reviewer follows to see the change working. -->

1.
2.

## AI assistance

<!-- Working with an agent is welcome and never a reason to reject a
     pull request. Every change is read and verified here either way;
     we ask because it tells us where a change comes from and what
     maturity to expect. Fill in what applies, or write "none" if this
     is hand written. -->

* Agent and version:
* Model and effort/reasoning level:
* Share written by the agent:
* Reviewed and understood before pushing:

## Checklist

* [ ] Targets `master`
* [ ] Commits are signed off (`git commit -s`)
* [ ] Commit subjects follow `[BUGFIX|TASK|FEATURE] Subject`
* [ ] `composer cgl` leaves the code unchanged
* [ ] `composer phpstan` passes
* [ ] `composer test` passes
* [ ] A bugfix comes with a test that fails without it — appreciated,
      not required
* [ ] Holds on every TYPO3 and PHP version declared in `composer.json`
* [ ] Assets rebuilt and committed if SCSS, JavaScript or icons changed
      (`npm --prefix Build ci && npm --prefix Build run build`)
* [ ] Documentation updated if the change is user facing
