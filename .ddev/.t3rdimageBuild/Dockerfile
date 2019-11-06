ARG BASE_IMAGE
FROM $BASE_IMAGE

ADD scripts /

HEALTHCHECK --interval=1s --retries=10 --timeout=120s --start-period=10s CMD ["/healthcheck.sh"]

CMD ["bashcmd","/start.sh"]
