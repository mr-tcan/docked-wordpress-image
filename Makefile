# Docker tasks

# Build steps
all: 4-9

# Version 4.9
4-9: 4-9-alpine

# recursive use of make
4-9-alpine:
		$(MAKE) -C ./4.9/alpine
