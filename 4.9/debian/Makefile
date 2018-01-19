# Docker tasks

# Docker Hub user/organization
NAMESPACE = dockium
# WordPress version
VERSION = 4.9.1
# Docker image revision
REVISION = 2

# Build steps
all: debian

debian:
	# tag: dockium/wordpress:4.9.1_2
	docker build -t $(NAMESPACE)/wordpress:$(VERSION)_$(REVISION) ./
