#!/usr/bin/env python3
"""
DIGITAL SOLUTIONS — traduzir.py
Gera i18n/en.json, no.json e es.json a partir das tabelas em
tools/_trad_a.py e tools/_trad_b.py, conferindo paridade com o mestre
i18n/pt.json antes de gravar.

  python3 tools/extrair-i18n.py   # primeiro: regera o mestre pt.json
  python3 tools/traduzir.py       # depois: regera en/no/es

Se uma chave existir no mestre e faltar na tabela, o script avisa e não
grava. É de propósito: tradução parcial silenciosa é pior que erro.

Documento controlado: DOC-DS-BUILD-004 · v1.0.0
"""
import json
import sys
from pathlib import Path

RAIZ = Path(__file__).resolve().parent.parent
sys.path.insert(0, str(RAIZ / "tools"))

import _trad_a
import _trad_b

TRAD = {**_trad_a.T, **_trad_b.T}
IDIOMAS = {"en": 0, "no": 1, "es": 2}


def main() -> None:
    mestre = json.loads((RAIZ / "i18n" / "pt.json").read_text(encoding="utf-8"))

    faltam = [k for k in mestre if k not in TRAD]
    orfas = [k for k in TRAD if k not in mestre]
    if faltam:
        print(f"  ERRO: {len(faltam)} chaves do mestre sem tradução:")
        for k in faltam:
            print(f"    · {k}")
    if orfas:
        print(f"  AVISO: {len(orfas)} chaves órfãs na tabela (não existem no mestre):")
        for k in orfas:
            print(f"    · {k}")
    if faltam:
        sys.exit(1)

    for lang, i in IDIOMAS.items():
        d = {k: TRAD[k][i] for k in mestre}
        (RAIZ / "i18n" / f"{lang}.json").write_text(
            json.dumps(d, ensure_ascii=False, indent=2) + "\n", encoding="utf-8"
        )
        print(f"  ✓ i18n/{lang}.json — {len(d)} chaves")


if __name__ == "__main__":
    main()
