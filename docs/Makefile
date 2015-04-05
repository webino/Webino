# Makefile for Sphinx documentation
#

# You can set these variables from the command line.
SPHINXOPTS    =
SPHINXBUILD   = sphinx-build
PAPER         =
BUILDDIR      = build
SOURCEDIR     = source

# User-friendly check for sphinx-build
ifeq ($(shell which $(SPHINXBUILD) >/dev/null 2>&1; echo $$?), 1)
$(error The '$(SPHINXBUILD)' command was not found. Make sure you have Sphinx installed, then set the SPHINXBUILD environment variable to point to the full path of the '$(SPHINXBUILD)' executable. Alternatively you can add the directory with the executable to your PATH. If you don't have Sphinx installed, grab it from http://sphinx-doc.org/)
endif

# Internal variables.
PAPEROPT_a4     = -D latex_paper_size=a4
PAPEROPT_letter = -D latex_paper_size=letter
ALLSPHINXOPTS   = -d $(BUILDDIR)/doctrees $(PAPEROPT_$(PAPER)) $(SPHINXOPTS) source

.PHONY: help clean html changes linkcheck doctest ghpages

help:
	@echo "Please use \`make <target>' where <target> is one of"
	@echo "  html       to make standalone HTML files"
	@echo "  changes    to make an overview of all changed/added/deprecated items"
	@echo "  linkcheck  to check all external links for integrity"
	@echo "  doctest    to run all doctests embedded in the documentation (if enabled)"
	@echo "  ghpages    to update Github pages"

clean:
	rm -rf $(BUILDDIR)/*

html:
	$(SPHINXBUILD) -b html -D language='en' $(ALLSPHINXOPTS) $(BUILDDIR)/html
	$(SPHINXBUILD) -b html -D language='sk' $(ALLSPHINXOPTS) $(BUILDDIR)/html/sk
	@echo
	@echo "Build finished. The HTML pages are in $(BUILDDIR)/html."

changes:
	$(SPHINXBUILD) -b changes $(ALLSPHINXOPTS) $(BUILDDIR)/changes
	@echo
	@echo "The overview file is in $(BUILDDIR)/changes."

linkcheck:
	$(SPHINXBUILD) -b linkcheck $(ALLSPHINXOPTS) $(BUILDDIR)/linkcheck
	@echo
	@echo "Link check complete; look for any errors in the above output " \
	      "or in $(BUILDDIR)/linkcheck/output.txt."

doctest:
	$(SPHINXBUILD) -b doctest $(ALLSPHINXOPTS) $(BUILDDIR)/doctest
	@echo "Testing of doctests in the sources finished, look at the " \
	      "results in $(BUILDDIR)/doctest/output.txt."

ghpages:
	@rm -rf gh-pages
	@git clone --branch=gh-pages https://$(GH_TOKEN)@$(GH_REF).git gh-pages
	@rm -rf gh-pages/*
	@cp -R build/html/* gh-pages/
	@cd gh-pages && touch .nojekyll
	@cd gh-pages && git add . -A
	@cd gh-pages && git commit -m "Updated docs"
	@cd gh-pages && git push origin gh-pages
	@echo "Github pages released."
