# Docker tasks

# Docker Hub user/organization
NAMESPACE = dockium
# WordPress version
VERSION = 4.9.1
# Docker image revision
REVISION = 1

# Build steps
all: debian

debian:
	# tag: dockium/wordpress:4.9.1_0-alpine
	docker build -t $(NAMESPACE)/wordpress:$(VERSION)_$(REVISION) ./
