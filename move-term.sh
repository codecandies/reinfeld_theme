#!/bin/bash
TERM="$1"

# Prüfen ob der Term in locations schon existiert
if ! wp term get locations "$TERM" --field=term_id &>/dev/null; then
  echo "Term '$TERM' existiert noch nicht in 'locations', lege ihn an..."
  wp term create locations "$TERM"
else
  echo "Term '$TERM' existiert bereits in 'locations', überspringe Anlage."
fi

for id in $(wp post list --post_type=post --tag="$TERM" --field=ID); do
  wp post term add $id locations "$TERM"
  wp post term remove $id post_tag "$TERM"
done

wp term delete post_tag $(wp term get post_tag "$TERM" --field=term_id)
