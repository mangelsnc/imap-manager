<?php

namespace ImapManager;

/**
 * @codeCoverageIgnore
 */
class ConnectionFlags
{
    const CONNECTION_FLAG_SERVICE = "/service=";
    const CONNECTION_FLAG_USER = "/user=";
    const CONNECTION_FLAG_AUTHUSER = "/authuser=";
    const CONNECTION_FLAG_ANONYMOUS = "/anonymous";
    const CONNECTION_FLAG_DEBUG = "/debug";
    const CONNECTION_FLAG_SECURE = "/secure";
    const CONNECTION_FLAG_POP3 = "/pop3";
    const CONNECTION_FLAG_IMAP = "/imap";
    const CONNECTION_FLAG_IMAP2 = "/imap2";
    const CONNECTION_FLAG_IMAP2BIS = "/imap2bis";
    const CONNECTION_FLAG_IMAP4 = "/imap4";
    const CONNECTION_FLAG_IMAP4REV1 = "/imap4rev1";
    const CONNECTION_FLAG_NNTP = "/nntp";
    const CONNECTION_FLAG_NORSH = "/norsh";
    const CONNECTION_FLAG_SSL = "/ssl";
    const CONNECTION_FLAG_VALIDATE_CERT = "/validate-cert";
    const CONNECTION_FLAG_NOVALIDATE_CERT = "/novalidate-cert";
    const CONNECTION_FLAG_TLS = "/tls";
    const CONNECTION_FLAG_NOTLS = "/notls";
    const CONNECTION_FLAG_READONLY = "/readonly";
}