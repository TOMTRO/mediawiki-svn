/* Loreley: Lightweight HTTP reverse-proxy.	*/
/* md5: MD5 digest implementation.		*/

/* @(#) $Id$ */

/*
 **********************************************************************
 ** md5.c                                                            **
 ** RSA Data Security, Inc. MD5 Message Digest Algorithm             **
 ** Created: 2/17/90 RLR                                             **
 ** Revised: 1/91 SRD,AJ,BSK,JT Reference C Version                  **
 **********************************************************************
 */

/*
 **********************************************************************
 ** Copyright (C) 1990, RSA Data Security, Inc. All rights reserved. **
 **                                                                  **
 ** License to copy and use this software is granted provided that   **
 ** it is identified as the "RSA Data Security, Inc. MD5 Message     **
 ** Digest Algorithm" in all material mentioning or referencing this **
 ** software or this function.                                       **
 **                                                                  **
 ** License is also granted to make and use derivative works         **
 ** provided that such works are identified as "derived from the RSA **
 ** Data Security, Inc. MD5 Message Digest Algorithm" in all         **
 ** material mentioning or referencing the derived work.             **
 **                                                                  **
 ** RSA Data Security, Inc. makes no representations concerning      **
 ** either the merchantability of this software or the suitability   **
 ** of this software for any particular purpose.  It is provided "as **
 ** is" without express or implied warranty of any kind.             **
 **                                                                  **
 ** These notices must be retained in any copies of any part of this **
 ** documentation and/or software.                                   **
 **********************************************************************
 */

#include <stdexcept>
using std::logic_error;

#include "md5.h"

namespace {

unsigned char PADDING[64] = {
  0x80, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,
  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,
  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,
  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,
  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,
  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,
  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,
  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00
};

/* F, G and H are basic MD5 functions: selection, majority, parity */
#define F(x, y, z) (((x) & (y)) | ((~x) & (z)))
#define G(x, y, z) (((x) & (z)) | ((y) & (~z)))
#define H(x, y, z) ((x) ^ (y) ^ (z))
#define I(x, y, z) ((y) ^ ((x) | (~z))) 

/* ROTATE_LEFT rotates x left n bits */
#define ROTATE_LEFT(x, n) (((x) << (n)) | ((x) >> (32-(n))))

/* FF, GG, HH, and II transformations for rounds 1, 2, 3, and 4 */
/* Rotation is separate from addition to prevent recomputation */
#define FF(a, b, c, d, x, s, ac) \
  {(a) += F ((b), (c), (d)) + (x) + (uint32_t)(ac); \
   (a) = ROTATE_LEFT ((a), (s)); \
   (a) += (b); \
  }
#define GG(a, b, c, d, x, s, ac) \
  {(a) += G ((b), (c), (d)) + (x) + (uint32_t)(ac); \
   (a) = ROTATE_LEFT ((a), (s)); \
   (a) += (b); \
  }
#define HH(a, b, c, d, x, s, ac) \
  {(a) += H ((b), (c), (d)) + (x) + (uint32_t)(ac); \
   (a) = ROTATE_LEFT ((a), (s)); \
   (a) += (b); \
  }
#define II(a, b, c, d, x, s, ac) \
  {(a) += I ((b), (c), (d)) + (x) + (uint32_t)(ac); \
   (a) = ROTATE_LEFT ((a), (s)); \
   (a) += (b); \
  }

/* Basic MD5 step. Transform buf based on in.
 */
void
Transform(uint32_t *buf, uint32_t *in)
{
  uint32_t a = buf[0], b = buf[1], c = buf[2], d = buf[3];

  /* Round 1 */
#define S11 7
#define S12 12
#define S13 17
#define S14 22
  FF ( a, b, c, d, in[ 0], S11, 3614090360u); /* 1 */
  FF ( d, a, b, c, in[ 1], S12, 3905402710u); /* 2 */
  FF ( c, d, a, b, in[ 2], S13,  606105819u); /* 3 */
  FF ( b, c, d, a, in[ 3], S14, 3250441966u); /* 4 */
  FF ( a, b, c, d, in[ 4], S11, 4118548399u); /* 5 */
  FF ( d, a, b, c, in[ 5], S12, 1200080426u); /* 6 */
  FF ( c, d, a, b, in[ 6], S13, 2821735955u); /* 7 */
  FF ( b, c, d, a, in[ 7], S14, 4249261313u); /* 8 */
  FF ( a, b, c, d, in[ 8], S11, 1770035416u); /* 9 */
  FF ( d, a, b, c, in[ 9], S12, 2336552879u); /* 10 */
  FF ( c, d, a, b, in[10], S13, 4294925233u); /* 11 */
  FF ( b, c, d, a, in[11], S14, 2304563134u); /* 12 */
  FF ( a, b, c, d, in[12], S11, 1804603682u); /* 13 */
  FF ( d, a, b, c, in[13], S12, 4254626195u); /* 14 */
  FF ( c, d, a, b, in[14], S13, 2792965006u); /* 15 */
  FF ( b, c, d, a, in[15], S14, 1236535329u); /* 16 */

  /* Round 2 */
#define S21 5
#define S22 9
#define S23 14
#define S24 20
  GG ( a, b, c, d, in[ 1], S21, 4129170786u); /* 17 */
  GG ( d, a, b, c, in[ 6], S22, 3225465664u); /* 18 */
  GG ( c, d, a, b, in[11], S23,  643717713u); /* 19 */
  GG ( b, c, d, a, in[ 0], S24, 3921069994u); /* 20 */
  GG ( a, b, c, d, in[ 5], S21, 3593408605u); /* 21 */
  GG ( d, a, b, c, in[10], S22,   38016083u); /* 22 */
  GG ( c, d, a, b, in[15], S23, 3634488961u); /* 23 */
  GG ( b, c, d, a, in[ 4], S24, 3889429448u); /* 24 */
  GG ( a, b, c, d, in[ 9], S21,  568446438u); /* 25 */
  GG ( d, a, b, c, in[14], S22, 3275163606u); /* 26 */
  GG ( c, d, a, b, in[ 3], S23, 4107603335u); /* 27 */
  GG ( b, c, d, a, in[ 8], S24, 1163531501u); /* 28 */
  GG ( a, b, c, d, in[13], S21, 2850285829u); /* 29 */
  GG ( d, a, b, c, in[ 2], S22, 4243563512u); /* 30 */
  GG ( c, d, a, b, in[ 7], S23, 1735328473u); /* 31 */
  GG ( b, c, d, a, in[12], S24, 2368359562u); /* 32 */

  /* Round 3 */
#define S31 4
#define S32 11
#define S33 16
#define S34 23
  HH ( a, b, c, d, in[ 5], S31, 4294588738u); /* 33 */
  HH ( d, a, b, c, in[ 8], S32, 2272392833u); /* 34 */
  HH ( c, d, a, b, in[11], S33, 1839030562u); /* 35 */
  HH ( b, c, d, a, in[14], S34, 4259657740u); /* 36 */
  HH ( a, b, c, d, in[ 1], S31, 2763975236u); /* 37 */
  HH ( d, a, b, c, in[ 4], S32, 1272893353u); /* 38 */
  HH ( c, d, a, b, in[ 7], S33, 4139469664u); /* 39 */
  HH ( b, c, d, a, in[10], S34, 3200236656u); /* 40 */
  HH ( a, b, c, d, in[13], S31,  681279174u); /* 41 */
  HH ( d, a, b, c, in[ 0], S32, 3936430074u); /* 42 */
  HH ( c, d, a, b, in[ 3], S33, 3572445317u); /* 43 */
  HH ( b, c, d, a, in[ 6], S34,   76029189u); /* 44 */
  HH ( a, b, c, d, in[ 9], S31, 3654602809u); /* 45 */
  HH ( d, a, b, c, in[12], S32, 3873151461u); /* 46 */
  HH ( c, d, a, b, in[15], S33,  530742520u); /* 47 */
  HH ( b, c, d, a, in[ 2], S34, 3299628645u); /* 48 */

  /* Round 4 */
#define S41 6
#define S42 10
#define S43 15
#define S44 21
  II ( a, b, c, d, in[ 0], S41, 4096336452u); /* 49 */
  II ( d, a, b, c, in[ 7], S42, 1126891415u); /* 50 */
  II ( c, d, a, b, in[14], S43, 2878612391u); /* 51 */
  II ( b, c, d, a, in[ 5], S44, 4237533241u); /* 52 */
  II ( a, b, c, d, in[12], S41, 1700485571u); /* 53 */
  II ( d, a, b, c, in[ 3], S42, 2399980690u); /* 54 */
  II ( c, d, a, b, in[10], S43, 4293915773u); /* 55 */
  II ( b, c, d, a, in[ 1], S44, 2240044497u); /* 56 */
  II ( a, b, c, d, in[ 8], S41, 1873313359u); /* 57 */
  II ( d, a, b, c, in[15], S42, 4264355552u); /* 58 */
  II ( c, d, a, b, in[ 6], S43, 2734768916u); /* 59 */
  II ( b, c, d, a, in[13], S44, 1309151649u); /* 60 */
  II ( a, b, c, d, in[ 4], S41, 4149444226u); /* 61 */
  II ( d, a, b, c, in[11], S42, 3174756917u); /* 62 */
  II ( c, d, a, b, in[ 2], S43,  718787259u); /* 63 */
  II ( b, c, d, a, in[ 9], S44, 3951481745u); /* 64 */

  buf[0] += a;
  buf[1] += b;
  buf[2] += c;
  buf[3] += d;
}

}; // anonymous namespace

void
md5::_md5init(md5::ctx_t *mdContext)
{
  mdContext->i[0] = mdContext->i[1] = 0;

  /* Load magic initialization constants.
   */
  mdContext->buf[0] = 0x67452301u;
  mdContext->buf[1] = 0xefcdab89u;
  mdContext->buf[2] = 0x98badcfeu;
  mdContext->buf[3] = 0x10325476u;
}

void
md5::_md5update (md5::ctx_t *mdContext, unsigned char const *inBuf, unsigned int inLen)
{
  uint32_t in[16];
  int mdi;
  unsigned int i, ii;

  /* compute number of bytes mod 64 */
  mdi = (int)((mdContext->i[0] >> 3) & 0x3F);

  /* update number of bits */
  if ((mdContext->i[0] + ((uint32_t)inLen << 3)) < mdContext->i[0])
    mdContext->i[1]++;
  mdContext->i[0] += ((uint32_t)inLen << 3);
  mdContext->i[1] += ((uint32_t)inLen >> 29);

  while (inLen--) {
    /* add new character to buffer, increment mdi */
    mdContext->in[mdi++] = *inBuf++;

    /* transform if necessary */
    if (mdi == 0x40) {
      for (i = 0, ii = 0; i < 16; i++, ii += 4)
        in[i] = (((uint32_t)mdContext->in[ii+3]) << 24) |
                (((uint32_t)mdContext->in[ii+2]) << 16) |
                (((uint32_t)mdContext->in[ii+1]) << 8) |
                ((uint32_t)mdContext->in[ii]);
      Transform (mdContext->buf, in);
      mdi = 0;
    }
  }
}

void
md5::_md5final(md5::ctx_t *mdContext)
{
  uint32_t in[16];
  int mdi;
  unsigned int i, ii;
  unsigned int padLen;

  /* save number of bits */
  in[14] = mdContext->i[0];
  in[15] = mdContext->i[1];

  /* compute number of bytes mod 64 */
  mdi = (int)((mdContext->i[0] >> 3) & 0x3F);

  /* pad out to 56 mod 64 */
  padLen = (mdi < 56) ? (56 - mdi) : (120 - mdi);
  _md5update(mdContext, PADDING, padLen);

  /* append length in bits and transform */
  for (i = 0, ii = 0; i < 14; i++, ii += 4)
    in[i] = (((uint32_t)mdContext->in[ii+3]) << 24) |
            (((uint32_t)mdContext->in[ii+2]) << 16) |
            (((uint32_t)mdContext->in[ii+1]) << 8) |
            ((uint32_t)mdContext->in[ii]);
  Transform(mdContext->buf, in);

  /* store buffer in digest */
  for (i = 0, ii = 0; i < 4; i++, ii += 4) {
    mdContext->digest[ii] = (unsigned char)(mdContext->buf[i] & 0xFF);
    mdContext->digest[ii+1] =
      (unsigned char)((mdContext->buf[i] >> 8) & 0xFF);
    mdContext->digest[ii+2] =
      (unsigned char)((mdContext->buf[i] >> 16) & 0xFF);
    mdContext->digest[ii+3] =
      (unsigned char)((mdContext->buf[i] >> 24) & 0xFF);
  }
}

md5::digest_t
md5::digest(void) const
{
	if (!_final)
		throw logic_error("MD5 object not finalised");

	return _ctx.digest;
}

md5::digest_t
md5::digest(void)
{
	_finalise();
	return _ctx.digest;
}

string
md5::strdigest(void) const
{
static char const *chars = "0123456789abcdef";
string	ret;
	if (!_final)
		throw logic_error("MD5 object not finalised");

	for (int i = 0; i < 16; ++i) {
		ret += chars[_ctx.digest[i] & 0xF];
		ret += chars[_ctx.digest[i] >> 4];
	}
	return ret;
}

string
md5::strdigest(void)
{
	_finalise();
	return static_cast<md5 const *>(this)->strdigest();
}

void
md5::_finalise(void)
{
	if (_final)
		return;
	_md5final(&_ctx);
	_final = true;
}
