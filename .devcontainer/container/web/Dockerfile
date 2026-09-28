FROM nginxinc/nginx-unprivileged:alpine-slim
ARG UID=1000
ARG GID=1000

USER root
# Install shadow utilities for usermod
RUN apk add --no-cache shadow

# Change IDs
RUN groupmod -g $GID nginx && usermod -u $UID nginx

USER nginx
