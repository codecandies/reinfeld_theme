#!/bin/bash
TERM="$1"
SLUG="$2"

# Prüfen ob der Term in locations schon existiert (per Slug)
if ! wp term get locations "$SLUG" --by=slug --field=term_id &>/dev/null; then
  echo "Term '$TERM' existiert noch nicht in 'locations', lege ihn an..."
  wp term create locations "$TERM"
else
  echo "Term '$TERM' existiert bereits in 'locations', überspringe Anlage."
fi

for id in $(wp post list --post_type=post --tag="$SLUG" --by=slug --field=ID); do
  wp post term add $id locations "$SLUG" --by=slug
  wp post term remove $id post_tag "$SLUG" --by=slug
done

# Term-ID explizit holen vor dem Löschen
TAG_ID=$(wp term get post_tag "$SLUG" --by=slug --field=term_id 2>/dev/null)
if [ -n "$TAG_ID" ]; then
  wp term delete post_tag $TAG_ID
else
  echo "Schlagwort '$TERM' nicht mehr vorhanden, nichts zu löschen."
fi
